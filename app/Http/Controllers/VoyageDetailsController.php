<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class VoyageDetailsController extends Controller
{
    public function show($reservation)
    {
        // Récupérer uniquement la réservation du client connecté
        $trip = Reservation::query()
            ->where('id', $reservation)
            ->where('user_id', auth()->id())
            ->with([
                'flight.departureAirport',
                'flight.arrivalAirport',
                'passengers',
                'baggage',
            ])
            ->firstOrFail();

        // Vérifier que le vol possède ses aéroports
        abort_if(
            !$trip->flight ||
            !$trip->flight->departureAirport ||
            !$trip->flight->arrivalAirport,
            404
        );

        // Calculer le nombre et le poids total des bagages
        $baggageCount = $trip->baggage->count();

        $totalBaggageWeight = $trip->baggage->sum('weight');

        // Déterminer le statut selon la date d'arrivée
        $isCompleted = $trip->flight->arrival_at <= now();

        $statusLabel = $isCompleted
            ? 'Voyage effectué'
            : 'Voyage à venir';

        return view('details_voyage', compact(
            'trip',
            'baggageCount',
            'totalBaggageWeight',
            'statusLabel'
        ));
    }
}