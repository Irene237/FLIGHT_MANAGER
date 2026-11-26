<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminAircraftController extends Controller
{
    /**
     * Afficher la page Avions & destinations.
     */
    public function index(Request $request)
    {
        // Construction de la requête des avions.
        $query = Aircraft::query();

        // Recherche par immatriculation, modèle ou constructeur.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('registration_number', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('manufacturer', 'like', "%{$search}%");
            });
        }

        // Filtrage par statut.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Liste des avions avec le nombre de vols associés.
        $aircraft = $query->withCount('flights')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Statistiques réelles provenant de MariaDB.
        $totalAircraft = Aircraft::count();

        $availableAircraft = Aircraft::where('status', 'available')->count();

        $unavailableAircraft = Aircraft::where('status', '!=', 'available')->count();

        $totalCapacity = Aircraft::sum('capacity');

        // Récupérer tous les aéroports enregistrés dans MariaDB.
        $airports = Airport::orderBy('city', 'asc')->get();

        // Récupérer l'avion sélectionné pour sa fiche détaillée.
        $selectedAircraft = null;

        if ($request->filled('selected')) {
            $selectedAircraft = Aircraft::with('flights')
                ->find($request->selected);
        }

        // Par défaut, sélectionner le dernier avion enregistré.
        if (!$selectedAircraft) {
            $selectedAircraft = Aircraft::with('flights')
                ->orderBy('created_at', 'desc')
                ->first();
        }

        return view('admin.aircraft.index', compact(
            'aircraft',
            'totalAircraft',
            'availableAircraft',
            'unavailableAircraft',
            'totalCapacity',
            'selectedAircraft',
            'airports'
        ));
    }

    /**
     * Afficher le formulaire d'ajout d'un avion.
     */
    public function create()
    {
        return view('admin.aircraft.create');
    }

    /**
     * Enregistrer un nouvel avion.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => [
                'required',
                'string',
                'max:50',
                'unique:aircraft,registration_number',
            ],

            'model' => ['required', 'string', 'max:100'],

            'manufacturer' => ['required', 'string', 'max:100'],

            'capacity' => ['required', 'integer', 'min:1'],

            'status' => [
                'required',
                Rule::in(['available', 'maintenance', 'unavailable']),
            ],
        ]);

        Aircraft::create($validated);

        return redirect()
            ->route('admin.aircraft.index')
            ->with('success', 'L’avion a été ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Aircraft $aircraft)
    {
        return view('admin.aircraft.edit', compact('aircraft'));
    }

    /**
     * Mettre à jour un avion.
     */
    public function update(Request $request, Aircraft $aircraft)
    {
        $validated = $request->validate([
            'registration_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('aircraft', 'registration_number')
                    ->ignore($aircraft->id),
            ],

            'model' => ['required', 'string', 'max:100'],

            'manufacturer' => ['required', 'string', 'max:100'],

            'capacity' => ['required', 'integer', 'min:1'],

            'status' => [
                'required',
                Rule::in(['available', 'maintenance', 'unavailable']),
            ],
        ]);

        // Calculer le nombre de places déjà réservées.
        $reservedSeats = $aircraft->flights()
            ->with(['reservations' => function ($query) {
                $query->whereIn('status', ['confirmed', 'pending']);
            }])
            ->get()
            ->sum(function ($flight) {
                return $flight->reservations->sum('number_of_seats');
            });

        // Empêcher de réduire la capacité sous les places réservées.
        if ($validated['capacity'] < $reservedSeats) {
            return back()
                ->withErrors([
                    'capacity' => "La capacité ne peut pas être inférieure aux {$reservedSeats} places déjà réservées."
                ])
                ->withInput();
        }

        // Vérifier les vols à venir avant de rendre l'avion indisponible.
        if ($validated['status'] !== 'available') {

            $hasUpcomingFlights = $aircraft->flights()
                ->where('departure_at', '>=', now())
                ->whereIn('status', ['scheduled', 'in_progress'])
                ->exists();

            if ($hasUpcomingFlights) {
                return back()
                    ->withErrors([
                        'status' => 'Cet avion est affecté à un vol à venir. Modifiez d’abord son affectation.'
                    ])
                    ->withInput();
            }
        }

        $aircraft->update($validated);

        return redirect()
            ->route('admin.aircraft.index')
            ->with('success', 'Les informations de l’avion ont été mises à jour.');
    }

    /**
     * Supprimer un avion.
     */
    public function destroy(Aircraft $aircraft)
    {
        // Vérifier si l'avion est associé à des vols.
        if ($aircraft->flights()->exists()) {
            return back()->with(
                'error',
                'Impossible de supprimer cet avion : il est associé à un ou plusieurs vols.'
            );
        }

        $aircraft->delete();

        return redirect()
            ->route('admin.aircraft.index')
            ->with('success', 'L’avion a été supprimé avec succès.');
    }
}