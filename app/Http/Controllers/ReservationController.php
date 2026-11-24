<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Reservation;
use App\Models\ReservationPassenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Afficher la page de réservation du vol sélectionné.
     */

    /**
 * Afficher les réservations du client connecté.
 */
public function index()
{
    $reservations = Reservation::where('user_id', auth()->id())
        ->with([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
            'passengers',
            'payments',
        ])
        ->latest('reserved_at')
        ->paginate(10);

    return view('mes_reservations', compact('reservations'));
}

/**
 * Annuler une réservation en attente.
 */
public function cancel(Reservation $reservation)
{
    // Vérifier que la réservation appartient au client connecté
    abort_unless($reservation->user_id === auth()->id(), 403);

    DB::transaction(function () use ($reservation) {

        // Verrouiller la réservation
        $lockedReservation = Reservation::whereKey($reservation->id)
            ->lockForUpdate()
            ->firstOrFail();

        // Seules les réservations en attente peuvent être annulées
        if ($lockedReservation->status !== 'pending') {
            throw ValidationException::withMessages([
                'reservation' => 'Cette réservation ne peut pas être annulée.',
            ]);
        }

        // Vérifier qu'aucun paiement réussi n'existe
        if ($lockedReservation->payments()
            ->where('status', 'successful')
            ->exists()) {

            throw ValidationException::withMessages([
                'reservation' => 'Une réservation déjà payée ne peut pas être annulée ici.',
            ]);
        }

        // Verrouiller le vol associé
        $flight = Flight::whereKey($lockedReservation->flight_id)
            ->lockForUpdate()
            ->firstOrFail();

        // Restituer les places disponibles
        $flight->increment(
            'available_seats',
            $lockedReservation->number_of_seats
        );

        // Modifier le statut de la réservation
        $lockedReservation->update([
            'status' => 'cancelled',
        ]);
    });

    return redirect()
        ->route('reservations.index')
        ->with('success', 'Votre réservation a été annulée avec succès. Les places ont été restituées.');
}

    public function create(Flight $flight)
    {
        $flight->load([
            'departureAirport',
            'arrivalAirport',
            'aircraft'
        ]);

        return view('reservation_passagers', compact('flight'));
    }

    /**
     * Enregistrer une réservation et ses passagers.
     */
    public function store(Request $request, Flight $flight)
    {
        $validated = $request->validate([
    'number_of_seats' => 'required|integer|min:1|max:9',

    'passengers' => 'required|array',

    'passengers.*.last_name' => 'required|string|max:255',
    'passengers.*.first_name' => 'required|string|max:255',
    'passengers.*.date_of_birth' => 'required|date|before:today',
    'passengers.*.nationality' => 'required|string|max:100',
    'passengers.*.email' => 'nullable|email|max:255',
    'passengers.*.phone' => 'nullable|string|max:30',
    'passengers.*.document_type' => 'required|in:Passeport,CNI',
    'passengers.*.passport_number' => 'required|string|max:100',
], [
    'number_of_seats.required' => 'Veuillez indiquer le nombre de passagers.',
    'number_of_seats.min' => 'Vous devez réserver au moins une place.',
    'passengers.*.last_name.required' => 'Le nom de chaque passager est obligatoire.',
    'passengers.*.first_name.required' => 'Le prénom de chaque passager est obligatoire.',
    'passengers.*.date_of_birth.required' => 'La date de naissance est obligatoire.',
    'passengers.*.nationality.required' => 'La nationalité est obligatoire.',
    'passengers.*.document_type.required' => 'Veuillez sélectionner le type de document.',
    'passengers.*.passport_number.required' => 'Le numéro du document est obligatoire.',
]);

        if (count($validated['passengers']) !== (int) $validated['number_of_seats']) {
            throw ValidationException::withMessages([
                'passengers' => 'Le nombre de formulaires passagers ne correspond pas au nombre de places.',
            ]);
        }

        $reservation = DB::transaction(function () use ($validated, $flight) {

            // Verrouiller le vol pendant la réservation
            $lockedFlight = Flight::whereKey($flight->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Vérifier les places disponibles
            if ($lockedFlight->available_seats < $validated['number_of_seats']) {
                throw ValidationException::withMessages([
                    'number_of_seats' => 'Désolé, il ne reste pas suffisamment de places sur ce vol.',
                ]);
            }

            // Générer une référence unique
            do {
                $reference = 'FM-' . Str::upper(Str::random(10));
            } while (Reservation::where('reference', $reference)->exists());

            // Calculer le montant total
            $totalAmount = $lockedFlight->price * $validated['number_of_seats'];

            // Créer la réservation
            $reservation = Reservation::create([
                'reference' => $reference,
                'user_id' => auth()->id(),
                'flight_id' => $lockedFlight->id,
                'total_amount' => $totalAmount,
                'number_of_seats' => $validated['number_of_seats'],
                'status' => 'pending',
                'reserved_at' => now(),
            ]);

            // Enregistrer les passagers
            foreach ($validated['passengers'] as $passengerData) {

                ReservationPassenger::create([
                    'reservation_id' => $reservation->id,
                    'first_name' => $passengerData['first_name'],
                    'last_name' => $passengerData['last_name'],
                    'date_of_birth' => $passengerData['date_of_birth'] ?? null,
                    'nationality' => $passengerData['nationality'] ?? null,
                    'passport_number' => $passengerData['passport_number'],
                    'gender' => null,
                ]);
            }

            // Déduire les places réservées
            $lockedFlight->decrement(
                'available_seats',
                $validated['number_of_seats']
            );

            return $reservation;
        });

        return redirect()
            ->route('bagages.index')
            ->with('success', 'Votre réservation ' . $reservation->reference . ' a été enregistrée. Vous pouvez maintenant gérer vos bagages.');
    }
}