<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Aircraft;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminFlightController extends Controller
{
    /**
     * Afficher la liste des vols.
     */
    public function index(Request $request)
    {
        $query = Flight::with([
            'departureAirport',
            'arrivalAirport',
            'aircraft'
        ]);

        // Recherche par numéro de vol ou aéroport
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('flight_number', 'like', "%{$search}%")
                    ->orWhereHas('departureAirport', function ($airport) use ($search) {
                        $airport->where('code', 'like', "%{$search}%")
                            ->orWhere('city', 'like', "%{$search}%");
                    })
                    ->orWhereHas('arrivalAirport', function ($airport) use ($search) {
                        $airport->where('code', 'like', "%{$search}%")
                            ->orWhere('city', 'like', "%{$search}%");
                    });
            });
        }

        // Filtrer par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $flights = $query
            ->orderByDesc('departure_at')
            ->paginate(10)
            ->withQueryString();

        $totalFlights = Flight::count();

        $scheduledFlights = Flight::where('status', 'scheduled')
            ->where('departure_at', '>=', now())
            ->count();

        $cancelledFlights = Flight::where('status', 'cancelled')->count();

        return view('admin.flights.index', compact(
            'flights',
            'totalFlights',
            'scheduledFlights',
            'cancelledFlights'
        ));
    }

    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        $airports = Airport::where('is_active', true)
            ->orderBy('city')
            ->get();

        $aircraft = Aircraft::where('status', 'available')
            ->orderBy('registration_number')
            ->get();

        return view('admin.flights.create', compact(
            'airports',
            'aircraft'
        ));
    }

    /**
     * Enregistrer un nouveau vol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => [
                'required',
                'string',
                'max:255',
                'unique:flights,flight_number'
            ],

            'departure_airport_id' => [
                'required',
                'exists:airports,id',
                'different:arrival_airport_id'
            ],

            'arrival_airport_id' => [
                'required',
                'exists:airports,id'
            ],

            'aircraft_id' => [
                'nullable',
                'exists:aircraft,id'
            ],

            'departure_at' => [
                'required',
                'date',
                'after:now'
            ],

            'arrival_at' => [
                'required',
                'date',
                'after:departure_at'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'available_seats' => [
                'required',
                'integer',
                'min:1'
            ],

            'status' => [
                'required',
                Rule::in([
                    'scheduled',
                    'in_progress',
                    'completed',
                    'cancelled'
                ])
            ],
        ]);

        // Vérifier que les deux aéroports sont actifs.
        $airports = Airport::whereIn('id', [
            $validated['departure_airport_id'],
            $validated['arrival_airport_id']
        ])->where('is_active', true)->count();

        if ($airports !== 2) {
            return back()
                ->withInput()
                ->withErrors([
                    'departure_airport_id' =>
                        'Les deux aéroports doivent être actifs.'
                ]);
        }

        // Vérifier la disponibilité et la capacité de l'avion.
        if (!empty($validated['aircraft_id'])) {
            $aircraft = Aircraft::findOrFail($validated['aircraft_id']);

            if ($aircraft->status !== 'available') {
                return back()
                    ->withInput()
                    ->withErrors([
                        'aircraft_id' => 'Cet avion n’est pas disponible.'
                    ]);
            }

            if ($validated['available_seats'] > $aircraft->capacity) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'available_seats' =>
                            'Le nombre de places dépasse la capacité de cet avion.'
                    ]);
            }
        }

        Flight::create($validated);

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Le vol a été ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Flight $flight)
    {
        $airports = Airport::orderBy('city')->get();

        $aircraft = Aircraft::where(function ($query) use ($flight) {
            $query->where('status', 'available')
                ->orWhere('id', $flight->aircraft_id);
        })->orderBy('registration_number')->get();

        return view('admin.flights.edit', compact(
            'flight',
            'airports',
            'aircraft'
        ));
    }

    /**
     * Mettre à jour un vol.
     */
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('flights', 'flight_number')->ignore($flight->id)
            ],

            'departure_airport_id' => [
                'required',
                'exists:airports,id',
                'different:arrival_airport_id'
            ],

            'arrival_airport_id' => [
                'required',
                'exists:airports,id'
            ],

            'aircraft_id' => [
                'nullable',
                'exists:aircraft,id'
            ],

            'departure_at' => [
                'required',
                'date'
            ],

            'arrival_at' => [
                'required',
                'date',
                'after:departure_at'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'available_seats' => [
                'required',
                'integer',
                'min:0'
            ],

            'status' => [
                'required',
                Rule::in([
                    'scheduled',
                    'in_progress',
                    'completed',
                    'cancelled'
                ])
            ],
        ]);

        // Vérifier que les aéroports sont actifs.
        $airports = Airport::whereIn('id', [
            $validated['departure_airport_id'],
            $validated['arrival_airport_id']
        ])->where('is_active', true)->count();

        if ($airports !== 2) {
            return back()
                ->withInput()
                ->withErrors([
                    'departure_airport_id' =>
                        'Les deux aéroports doivent être actifs.'
                ]);
        }

        // Vérifier l'avion et sa capacité.
        if (!empty($validated['aircraft_id'])) {
            $aircraft = Aircraft::findOrFail($validated['aircraft_id']);

            if (
                $aircraft->status !== 'available'
                && $aircraft->id !== $flight->aircraft_id
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'aircraft_id' => 'Cet avion n’est pas disponible.'
                    ]);
            }

            if ($validated['available_seats'] > $aircraft->capacity) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'available_seats' =>
                            'Le nombre de places dépasse la capacité de cet avion.'
                    ]);
            }
        }

        // Ne pas réduire les places sous le nombre déjà réservé.
        $reservedSeats = DB::table('reservations')
            ->where('flight_id', $flight->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->sum('number_of_seats');

        if ($validated['available_seats'] < $reservedSeats) {
            return back()
                ->withInput()
                ->withErrors([
                    'available_seats' =>
                        "Impossible : {$reservedSeats} place(s) sont déjà réservées."
                ]);
        }

        $flight->update($validated);

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Le vol a été modifié avec succès.');
    }

    /**
     * Supprimer un vol.
     */
    public function destroy(Flight $flight)
    {
        // Protéger l'historique des réservations.
        if ($flight->reservations()->exists()) {
            return back()->with(
                'error',
                'Ce vol possède déjà des réservations. Vous ne pouvez pas le supprimer.'
            );
        }

        $flight->delete();

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Le vol a été supprimé avec succès.');
    }
}