<?php

namespace App\Http\Controllers;

use App\Models\Baggage;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class BaggageController extends Controller
{
    /**
     * Afficher les bagages du client connecté.
     */
    public function index()
    {
        $user = auth()->user();

        $baggages = Baggage::whereHas('reservation', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with([
                'reservation',
                'passenger',
                'reservation.flight.departureAirport',
                'reservation.flight.arrivalAirport'
            ])
            ->latest()
            ->get();

        $reservations = Reservation::where('user_id', $user->id)
            ->with('passengers')
            ->latest('reserved_at')
            ->get();

        return view('bagages', compact('baggages', 'reservations'));
    }

    /**
     * Enregistrer réellement les bagages dans MariaDB.
     */
    public function store(Request $request)
    {
        // Vérifier les informations envoyées par le formulaire.
        $validated = $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id',
            'reservation_passenger_id' => 'required|integer|exists:reservation_passengers,id',
            'quantity' => 'required|integer|min:1|max:10',
            'type' => 'required|in:supplementaire,soute,special',
        ]);

        // Vérifier que la réservation appartient au client connecté.
        $reservation = Reservation::where('user_id', auth()->id())
            ->find($validated['reservation_id']);

        if (!$reservation) {
            throw ValidationException::withMessages([
                'reservation_id' => 'Cette réservation ne vous appartient pas.',
            ]);
        }

        // Vérifier que le passager appartient bien à cette réservation.
        $passengerExists = $reservation->passengers()
            ->whereKey($validated['reservation_passenger_id'])
            ->exists();

        if (!$passengerExists) {
            throw ValidationException::withMessages([
                'reservation_passenger_id' => 'Ce passager ne correspond pas à cette réservation.',
            ]);
        }

        // Déterminer le poids unitaire côté serveur.
        $unitWeight = $validated['type'] === 'special' ? 32 : 23;

        // Enregistrer tous les bagages dans une transaction.
        DB::transaction(function () use ($validated, $reservation, $unitWeight) {

            for ($i = 0; $i < $validated['quantity']; $i++) {

                // Générer un numéro d'étiquette unique.
                do {
                    $tagNumber = 'BAG-' . Str::upper(Str::random(10));
                } while (Baggage::where('tag_number', $tagNumber)->exists());

                Baggage::create([
                    'tag_number' => $tagNumber,
                    'reservation_id' => $reservation->id,
                    'reservation_passenger_id' => $validated['reservation_passenger_id'],
                    'weight' => $unitWeight,
                    'type' => $validated['type'],
                    'status' => 'registered',
                ]);
            }
        });

        return redirect()
            ->route('bagages.index')
            ->with('success', 'Vos bagages ont été enregistrés avec succès !');
    }
}