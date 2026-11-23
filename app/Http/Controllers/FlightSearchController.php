<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightSearchController extends Controller
{
    /**
     * Afficher la page de recherche des vols.
     */
    public function index()
    {
        $airports = Airport::where('is_active', true)
            ->orderBy('city')
            ->get();

        return view('recherche_vols', compact('airports'));
    }

    /**
     * Rechercher les vols disponibles dans MariaDB.
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
        ], [
            'departure_airport_id.required' => 'Veuillez choisir une ville de départ.',
            'arrival_airport_id.required' => 'Veuillez choisir une ville d’arrivée.',
            'arrival_airport_id.different' => 'Les villes de départ et d’arrivée doivent être différentes.',
            'departure_date.required' => 'Veuillez choisir une date de départ.',
            'departure_date.after_or_equal' => 'La date de départ ne peut pas être dans le passé.',
            'return_date.after_or_equal' => 'La date de retour doit être postérieure ou égale à la date de départ.',
            'passengers.required' => 'Veuillez indiquer le nombre de passagers.',
        ]);

        // Récupérer les vols correspondant aux critères.
        $flights = Flight::with([
                'departureAirport',
                'arrivalAirport',
                'aircraft'
            ])
            ->where('departure_airport_id', $validated['departure_airport_id'])
            ->where('arrival_airport_id', $validated['arrival_airport_id'])
            ->whereDate('departure_at', $validated['departure_date'])
            ->where('available_seats', '>=', $validated['passengers'])
            ->orderBy('departure_at')
            ->get();

        return view('resultats_recherche', [
            'flights' => $flights,
            'searchData' => $validated,
        ]);
    }
}