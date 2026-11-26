<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    /**
     * Afficher la page de recherche.
     */
    public function index()
    {
        $airports = Airport::where('is_active', true)
            ->orderBy('city')
            ->get();

        return view('recherche_vols', compact('airports'));
    }

    /**
     * Rechercher les vols correspondant aux critères.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'departure_airport_id' => 'required|integer|exists:airports,id',
            'arrival_airport_id' => 'required|integer|different:departure_airport_id|exists:airports,id',
            'departure_date' => 'required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'passengers' => 'required|integer|min:1|max:9',
            'cabin_class' => 'nullable|in:economique,affaires,premiere',
        ]);

        // Recherche exacte.
        $flights = Flight::with([
                'departureAirport',
                'arrivalAirport',
                'aircraft'
            ])
            ->where('departure_airport_id', $validated['departure_airport_id'])
            ->where('arrival_airport_id', $validated['arrival_airport_id'])
            ->whereDate('departure_at', $validated['departure_date'])
            ->where('departure_at', '>=', now())
            ->where('available_seats', '>=', $validated['passengers'])
            ->where('status', 'scheduled')
            ->orderBy('departure_at')
            ->get();

        $isFallback = false;

        // Si aucun résultat exact, proposer les autres vols disponibles.
        if ($flights->isEmpty()) {

            $flights = Flight::with([
                    'departureAirport',
                    'arrivalAirport',
                    'aircraft'
                ])
                ->where('departure_at', '>=', now())
                ->where('available_seats', '>=', $validated['passengers'])
                ->where('status', 'scheduled')
                ->orderBy('departure_at')
                ->get();

            $isFallback = true;
        }

        return view('resultats_recherche', [
            'flights' => $flights,
            'searchData' => $validated,
            'isFallback' => $isFallback,
            'isAllFlightsPage' => false,
        ]);
    }

    /**
     * Afficher tous les vols disponibles.
     */
    public function allAvailable()
    {
        $flights = Flight::with([
                'departureAirport',
                'arrivalAirport',
                'aircraft'
            ])
            ->where('departure_at', '>=', now())
            ->where('available_seats', '>', 0)
            ->where('status', 'scheduled')
            ->orderBy('departure_at')
            ->get();

        return view('resultats_recherche', [
            'flights' => $flights,
            'searchData' => [],
            'isFallback' => false,
            'isAllFlightsPage' => true,
        ]);
    }
}