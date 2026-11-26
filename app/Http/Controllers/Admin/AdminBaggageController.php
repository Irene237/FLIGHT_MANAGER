<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Baggage;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminBaggageController extends Controller
{
    /**
     * Afficher tous les bagages.
     */
    public function index(Request $request)
    {
        $query = Baggage::with([
            'reservation.user',
            'reservation.flight.departureAirport',
            'reservation.flight.arrivalAirport',
            'passenger'
        ]);

        // Recherche par étiquette, client ou passager.
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('tag_number', 'like', "%{$search}%")

                    ->orWhereHas('reservation.user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })

                    ->orWhereHas('passenger', function ($passengerQuery) use ($search) {
                        $passengerQuery->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            });
        }

        // Filtrage par numéro de vol.
        if ($request->filled('flight')) {
            $flight = $request->flight;

            $query->whereHas('reservation.flight', function ($flightQuery) use ($flight) {
                $flightQuery->where('flight_number', $flight);
            });
        }

        // Filtrage par statut.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtrage par type.
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Liste paginée.
        $baggages = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistiques réelles.
        $totalBaggages = Baggage::count();

        $registeredBaggages = Baggage::where('status', 'registered')->count();

        $deliveredBaggages = Baggage::where('status', 'delivered')->count();

        $problemBaggages = Baggage::whereIn('status', [
            'delayed',
            'lost',
            'damaged'
        ])->count();

        $totalWeight = Baggage::sum('weight');

        // Vols disponibles pour le filtre.
        // Utilisation des relations existantes dans le modèle Baggage.
        $flightOptions = Baggage::with('reservation.flight')
            ->get()
            ->map(function ($baggage) {
                return $baggage->reservation?->flight?->flight_number;
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.baggage.index', compact(
            'baggages',
            'totalBaggages',
            'registeredBaggages',
            'deliveredBaggages',
            'problemBaggages',
            'totalWeight',
            'flightOptions'
        ));
    }


    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        $reservations = Reservation::with([
            'user',
            'passengers',
            'flight.departureAirport',
            'flight.arrivalAirport'
        ])
            ->latest('reserved_at')
            ->get();

        return view('admin.baggage.create', compact('reservations'));
    }


    /**
     * Enregistrer un nouveau bagage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'reservation_id' => [
                'required',
                'integer',
                'exists:reservations,id'
            ],

            'reservation_passenger_id' => [
                'required',
                'integer',
                'exists:reservation_passengers,id'
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0.1',
                'max:9999.99'
            ],

            'type' => [
                'required',
                'in:supplementaire,soute,special'
            ],

            'status' => [
                'required',
                'in:registered,checked_in,loaded,in_transit,delayed,delivered,lost,damaged'
            ],

        ]);

        // Vérifier que le passager appartient à la réservation.
        $reservation = Reservation::with('passengers')
            ->findOrFail($validated['reservation_id']);

        $passengerExists = $reservation->passengers()
            ->whereKey($validated['reservation_passenger_id'])
            ->exists();

        if (!$passengerExists) {
            throw ValidationException::withMessages([
                'reservation_passenger_id' =>
                    'Le passager sélectionné ne correspond pas à cette réservation.'
            ]);
        }

        // Générer une étiquette unique.
        do {
            $tagNumber = 'BAG-' . Str::upper(Str::random(10));
        } while (Baggage::where('tag_number', $tagNumber)->exists());

        Baggage::create([
            'tag_number' => $tagNumber,
            'reservation_id' => $validated['reservation_id'],
            'reservation_passenger_id' => $validated['reservation_passenger_id'],
            'weight' => $validated['weight'],
            'type' => $validated['type'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Le bagage a été enregistré avec succès.');
    }


    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Baggage $baggage)
    {
        $baggage->load([
            'reservation.user',
            'passenger'
        ]);

        $reservations = Reservation::with([
            'user',
            'passengers'
        ])
            ->latest('reserved_at')
            ->get();

        return view('admin.baggage.edit', compact(
            'baggage',
            'reservations'
        ));
    }


    /**
     * Modifier un bagage.
     */
    public function update(Request $request, Baggage $baggage)
    {
        $validated = $request->validate([

            'reservation_id' => [
                'required',
                'integer',
                'exists:reservations,id'
            ],

            'reservation_passenger_id' => [
                'required',
                'integer',
                'exists:reservation_passengers,id'
            ],

            'weight' => [
                'required',
                'numeric',
                'min:0.1',
                'max:9999.99'
            ],

            'type' => [
                'required',
                'in:supplementaire,soute,special'
            ],

            'status' => [
                'required',
                'in:registered,checked_in,loaded,in_transit,delayed,delivered,lost,damaged'
            ],

        ]);

        // Vérifier la cohérence réservation / passager.
        $reservation = Reservation::findOrFail($validated['reservation_id']);

        $passengerExists = $reservation->passengers()
            ->whereKey($validated['reservation_passenger_id'])
            ->exists();

        if (!$passengerExists) {
            throw ValidationException::withMessages([
                'reservation_passenger_id' =>
                    'Le passager sélectionné ne correspond pas à cette réservation.'
            ]);
        }

        $baggage->update([
            'reservation_id' => $validated['reservation_id'],
            'reservation_passenger_id' => $validated['reservation_passenger_id'],
            'weight' => $validated['weight'],
            'type' => $validated['type'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Le bagage a été modifié avec succès.');
    }


    /**
     * Signaler un incident sur un bagage.
     */
    public function reportIncident(Request $request)
    {
        $validated = $request->validate([

            'incident_ref' => [
                'required',
                'string',
                'exists:baggage,tag_number'
            ],

            'incident_type' => [
                'required',
                'in:delayed,lost,damaged'
            ],

            'incident_comment' => [
                'nullable',
                'string',
                'max:1000'
            ],

        ], [

            'incident_ref.required' =>
                'Veuillez saisir la référence du bagage.',

            'incident_ref.exists' =>
                'Aucun bagage ne correspond à cette référence.',

            'incident_type.required' =>
                'Veuillez sélectionner un type d’incident.',

            'incident_comment.max' =>
                'Le commentaire ne doit pas dépasser 1000 caractères.',

        ]);

        // Retrouver le bagage dans la base de données.
        $baggage = Baggage::where(
            'tag_number',
            $validated['incident_ref']
        )->firstOrFail();

        // Mettre à jour le statut et le commentaire.
        $baggage->status = $validated['incident_type'];

        $baggage->incident_comment =
            $validated['incident_comment'] ?? null;

        $baggage->save();

        return redirect()
            ->route('admin.baggage.index')
            ->with(
                'success',
                'L’incident du bagage ' .
                $baggage->tag_number .
                ' a été enregistré avec succès.'
            );
    }


    /**
     * Supprimer un bagage.
     */
    public function destroy(Baggage $baggage)
    {
        $baggage->delete();

        return redirect()
            ->route('admin.baggage.index')
            ->with('success', 'Le bagage a été supprimé avec succès.');
    }
}