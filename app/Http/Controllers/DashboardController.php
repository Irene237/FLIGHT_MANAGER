<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Récupérer les cinq réservations les plus récentes
        // de l'utilisateur connecté.
        $recentReservations = $user->reservations()
           ->with([
    'flight.departureAirport',
    'flight.arrivalAirport',
    'payments'
])
            ->latest('reserved_at')
            ->take(5)
            ->get();

        // Compter les réservations de l'utilisateur.
        $totalReservations = $user->reservations()->count();

        // Rechercher le prochain voyage à venir.
        $nextTrip = $user->reservations()
            ->whereNotIn('status', [
                'cancelled',
                'canceled',
                'annulee',
                'annulée'
            ])
            ->whereHas('flight', function ($query) {
                $query->where('departure_at', '>=', now());
            })
            ->with([
                'flight.departureAirport',
                'flight.arrivalAirport',
                'flight.aircraft'
            ])
            ->get()
            ->sortBy(function ($reservation) {
                return $reservation->flight->departure_at;
            })
            ->first();

        return view('dashboard', compact(
            'recentReservations',
            'totalReservations',
            'nextTrip'
        ));
    }
}