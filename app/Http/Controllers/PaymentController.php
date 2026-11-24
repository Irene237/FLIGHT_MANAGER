<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    /**
     * Afficher la page de paiement et le billet électronique.
     */
    public function create(Reservation $reservation)
    {
        abort_unless($reservation->user_id === auth()->id(), 403);

        $reservation->load([
            'flight.departureAirport',
            'flight.arrivalAirport',
            'passengers',
            'payments',
        ]);

        $flight = $reservation->flight;

        // Rechercher le paiement réussi associé à cette réservation.
        $payment = $reservation->payments
            ->where('status', 'successful')
            ->sortByDesc('paid_at')
            ->first();

        $qrCode = null;

        // Générer le QR code uniquement si le paiement est réussi.
        if ($payment && $flight) {

            $qrData = [
                'application' => 'FLIGHT MANAGER',
                'reservation_reference' => $reservation->reference,
                'flight_number' => $flight->flight_number,
                'departure' => $flight->departureAirport->code,
                'arrival' => $flight->arrivalAirport->code,
                'departure_datetime' => $flight->departure_at,
                'arrival_datetime' => $flight->arrival_at,
                'number_of_seats' => $reservation->number_of_seats,
                'amount_paid' => $payment->amount,
                'transaction_reference' => $payment->transaction_reference,
                'payment_status' => $payment->status,
            ];

            $qrContent = json_encode(
                $qrData,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            );

            $qrCode = \tbQuar\Facades\Quar::size(200)
                ->generate($qrContent);
        }

        return view('paiement', compact(
            'reservation',
            'qrCode'
        ));
    }

    /**
     * Effectuer une simulation de paiement.
     */
    /**
 * Effectuer une simulation de paiement sécurisée.
 */
public function store(Request $request, Reservation $reservation)
{
    abort_unless($reservation->user_id === auth()->id(), 403);

    $validated = $request->validate([
        'payment_method' => [
            'required',
            'in:mtn_mobile_money,orange_money,bank_card',
        ],
        'phone_number' => [
            'nullable',
            'string',
            'max:30',
        ],
    ]);

    $result = DB::transaction(function () use ($reservation, $validated) {

        $lockedReservation = Reservation::whereKey($reservation->id)
            ->lockForUpdate()
            ->firstOrFail();

        // Empêcher un deuxième paiement réussi.
        if (
            $lockedReservation->status === 'confirmed' ||
            $lockedReservation->payments()
                ->where('status', 'successful')
                ->exists()
        ) {
            return 'already_paid';
        }

        // Le résultat est décidé côté serveur.
        // Aucun champ du navigateur ne peut forcer la réussite.
        Payment::create([
            'reservation_id' => $lockedReservation->id,
            'transaction_reference' => 'TXN-' . Str::upper(Str::random(12)),
            'payment_method' => $validated['payment_method'],
            'amount' => $lockedReservation->total_amount,
            'status' => 'successful',
            'paid_at' => now(),
        ]);

        $lockedReservation->update([
            'status' => 'confirmed',
        ]);

        return 'successful';
    });

    if ($result === 'already_paid') {
        return redirect()
            ->route('paiements.create', $reservation)
            ->with('error', 'Cette réservation a déjà été payée.');
    }

    return redirect()
        ->route('paiements.create', $reservation)
        ->with('success', 'Paiement simulé réussi ! Votre réservation est maintenant confirmée.');
}
    /**
 * Télécharger le billet électronique au format PDF.
 */
public function downloadPdf(Reservation $reservation)
{
    // Vérifier que la réservation appartient à l'utilisateur connecté.
    abort_unless($reservation->user_id === auth()->id(), 403);

    // Charger les informations de la réservation.
    $reservation->load([
        'flight.departureAirport',
        'flight.arrivalAirport',
        'passengers',
    ]);

    // Vérifier que la réservation est confirmée.
abort_unless($reservation->status === 'confirmed', 403);

    // Récupérer le paiement réussi.
    $payment = $reservation->payments()
        ->where('status', 'successful')
        ->latest('paid_at')
        ->firstOrFail();

    $flight = $reservation->flight;

    abort_unless($flight, 404);

    // Préparer les informations du QR code.
    $qrData = [
        'application' => 'FLIGHT MANAGER',
        'reservation_reference' => $reservation->reference,
        'flight_number' => $flight->flight_number,
        'departure' => $flight->departureAirport->code,
        'arrival' => $flight->arrivalAirport->code,
        'departure_datetime' => $flight->departure_at,
        'arrival_datetime' => $flight->arrival_at,
        'number_of_seats' => $reservation->number_of_seats,
        'amount_paid' => $payment->amount,
        'transaction_reference' => $payment->transaction_reference,
        'payment_status' => $payment->status,
    ];

    $qrContent = json_encode(
        $qrData,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );

    $qrCode = \tbQuar\Facades\Quar::size(200)
        ->generate($qrContent);

    // Générer le PDF.
    $pdf = Pdf::loadView('billet_pdf', [
        'reservation' => $reservation,
        'payment' => $payment,
        'flight' => $flight,
        'qrCode' => $qrCode,
    ]);

    $pdf->setPaper('A4', 'portrait');

    return $pdf->download(
        'billet-' . $reservation->reference . '.pdf'
    );
}
}