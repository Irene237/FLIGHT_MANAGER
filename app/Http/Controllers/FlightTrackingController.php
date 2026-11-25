<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class FlightTrackingController extends Controller
{
    public function show(Reservation $reservation)
    {
        // Sécurité : vérifier que la réservation appartient au client connecté.
        abort_unless(
            (int) $reservation->user_id === (int) Auth::id(),
            403,
            'Vous ne pouvez pas consulter cette réservation.'
        );

        // Charger les informations nécessaires.
        $reservation->load([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
            'checkIns',
            'passengers',
        ]);

        $flight = $reservation->flight;

        abort_if(!$flight, 404, 'Vol introuvable.');

        // Vérifier que les informations des aéroports existent.
        abort_if(
            !$flight->departureAirport || !$flight->arrivalAirport,
            404,
            'Les informations des aéroports sont introuvables.'
        );

        // Vérifier le nombre de passagers enregistrés.
        $passengerCount = $reservation->passengers->count();
        $checkInCount = $reservation->checkIns->count();

        $hasCheckedIn = $passengerCount > 0
            && $checkInCount >= $passengerCount;

        // Déterminer l'état du vol à partir des horaires prévus.
        $now = now();

        if ($flight->arrival_at && $now->greaterThanOrEqualTo($flight->arrival_at)) {
            $flightStage = 'arrived';
            $statusLabel = 'Arrivé';
            $flightStageClass = '';
        } elseif ($flight->departure_at && $now->greaterThanOrEqualTo($flight->departure_at)) {
            $flightStage = 'in_progress';
            $statusLabel = 'En cours';
            $flightStageClass = '';
        } else {
            $flightStage = 'scheduled';
            $statusLabel = "À l'heure";
            $flightStageClass = '';
        }

        // Construire les étapes de progression.
        $steps = [
            [
                'key' => 'checkin',
                'label' => 'Enregistrement',
                'done' => $hasCheckedIn,
                'current' => !$hasCheckedIn,
            ],
            [
                'key' => 'preparation',
                'label' => 'Vol en préparation',
                'done' => in_array($flightStage, ['in_progress', 'arrived']),
                'current' => $flightStage === 'scheduled' && $hasCheckedIn,
            ],
            [
                'key' => 'arrival',
                'label' => 'Arrivée',
                'done' => $flightStage === 'arrived',
                'current' => $flightStage === 'in_progress',
            ],
        ];

        return view('suivi_vol', compact(
            'reservation',
            'flight',
            'steps',
            'statusLabel',
            'flightStageClass',
            'hasCheckedIn'
        ));
    }
}