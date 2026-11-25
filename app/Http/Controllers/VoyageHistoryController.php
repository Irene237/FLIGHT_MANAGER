<?php

namespace App\Http\Controllers;

use App\Models\Reservation;

class VoyageHistoryController extends Controller
{
    public function index()
    {
        // Récupérer les réservations du client connecté.
        $pastTrips = Reservation::query()
            ->where('user_id', auth()->id())

            // Exclure les réservations annulées.
            ->whereNotIn('status', ['cancelled', 'canceled'])

            // Charger les informations nécessaires.
            ->with([
                'flight.departureAirport',
                'flight.arrivalAirport',
            ])

            // Ne conserver que les vols déjà arrivés.
            ->whereHas('flight', function ($query) {
                $query->whereNotNull('arrival_at')
                    ->where('arrival_at', '<=', now());
            })

            ->get()

            // Classer les voyages du plus récent au plus ancien.
            ->sortByDesc(function ($reservation) {
                return $reservation->flight->departure_at;
            })

            ->values();

        return view('historique_voyages', compact('pastTrips'));
    }
}