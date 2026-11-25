<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationPassenger;
use App\Models\Flight;
use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckInController extends Controller
{
    /**
     * Afficher les réservations disponibles
     * pour l'enregistrement en ligne.
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->whereHas('payments', function ($query) {
                $query->where('status', 'successful');
            })
            ->whereHas('flight', function ($query) {
                $query->where('departure_at', '>', now());
            })
            ->with([
                'flight.departureAirport',
                'flight.arrivalAirport',
                'flight.aircraft',
                'passengers.checkIns',
                'payments',
            ])
            ->latest('reserved_at')
            ->get();

        return view('enregistrement_en_ligne', compact('reservations'));
    }

    /**
     * Enregistrer un passager et lui attribuer un siège.
     */
    public function store(
        Request $request,
        Reservation $reservation,
        ReservationPassenger $passenger
    ) {
        // Vérifier que la réservation appartient à l'utilisateur.
        abort_unless(
            $reservation->user_id === auth()->id(),
            403
        );

        // Vérifier que le passager appartient à cette réservation.
        abort_unless(
            $passenger->reservation_id === $reservation->id,
            404
        );

        DB::transaction(function () use ($reservation, $passenger) {

            // Verrouiller la réservation.
            $lockedReservation = Reservation::whereKey($reservation->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Vérifier le statut de la réservation.
            if ($lockedReservation->status !== 'confirmed') {
                throw ValidationException::withMessages([
                    'checkin' => 'Cette réservation n’est pas confirmée.',
                ]);
            }

            // Vérifier que le paiement est réussi.
            if (!$lockedReservation->payments()
                ->where('status', 'successful')
                ->exists()) {

                throw ValidationException::withMessages([
                    'checkin' => 'Le paiement de cette réservation n’est pas confirmé.',
                ]);
            }

            // Vérifier que le vol existe et verrouiller sa ligne.
            $flight = Flight::whereKey($lockedReservation->flight_id)
                ->lockForUpdate()
                ->with('aircraft')
                ->firstOrFail();

            // Vérifier que le vol n'est pas déjà parti.
            if ($flight->departure_at <= now()) {
                throw ValidationException::withMessages([
                    'checkin' => 'Le check-in n’est plus disponible pour ce vol.',
                ]);
            }

            // Vérifier que l'avion est associé au vol.
            if (!$flight->aircraft) {
                throw ValidationException::withMessages([
                    'checkin' => 'Aucun avion n’est associé à ce vol.',
                ]);
            }

            // Empêcher un deuxième check-in pour ce passager.
            $alreadyCheckedIn = CheckIn::where(
                'reservation_id',
                $lockedReservation->id
            )
                ->where('reservation_passenger_id', $passenger->id)
                ->exists();

            if ($alreadyCheckedIn) {
                throw ValidationException::withMessages([
                    'checkin' => 'Ce passager est déjà enregistré.',
                ]);
            }

            // Récupérer la capacité réelle de l'avion.
            $capacity = $flight->aircraft->capacity;

            // Récupérer les sièges déjà attribués sur ce vol.
            $takenSeats = CheckIn::where('flight_id', $flight->id)
                ->pluck('seat_number')
                ->all();

            // Rechercher le premier siège disponible.
            $seatNumber = null;

            for ($seat = 1; $seat <= $capacity; $seat++) {
                if (!in_array((string) $seat, $takenSeats, true)) {
                    $seatNumber = $seat;
                    break;
                }
            }

            // Aucun siège disponible.
            if ($seatNumber === null) {
                throw ValidationException::withMessages([
                    'checkin' => 'Aucun siège disponible sur cet avion.',
                ]);
            }

            // Générer une référence unique.
            $reference = 'CHK-' . Str::upper(Str::random(10));

            // Enregistrer le check-in.
            CheckIn::create([
                'reservation_id' => $lockedReservation->id,
                'reservation_passenger_id' => $passenger->id,
                'flight_id' => $flight->id,
                'checkin_reference' => $reference,
                'seat_number' => (string) $seatNumber,
                'checked_in_at' => now(),
            ]);
        });

        return redirect()
            ->back()
            ->with(
                'success',
                'Enregistrement effectué avec succès ! Votre siège vous a été attribué.'
            );
    }

    /**
     * Afficher la carte d'embarquement d'un passager.
     */
    public function boardingPass(CheckIn $checkIn)
    {
        // Vérifier que la carte appartient à l'utilisateur connecté.
        abort_unless(
            $checkIn->reservation()
                ->where('user_id', auth()->id())
                ->exists(),
            403
        );

        // Charger toutes les informations nécessaires.
        $checkIn->load([
            'reservation',
            'passenger',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
        ]);

        // Générer les données du QR code.
        $qrData = json_encode([
            'application' => 'FLIGHT MANAGER',
            'checkin_reference' => $checkIn->checkin_reference,
            'passenger' => $checkIn->passenger->first_name . ' ' . $checkIn->passenger->last_name,
            'flight' => $checkIn->flight->flight_number,
            'seat' => $checkIn->seat_number,
            'departure' => $checkIn->flight->departureAirport->code,
            'arrival' => $checkIn->flight->arrivalAirport->code,
            'departure_at' => $checkIn->flight->departure_at->toDateTimeString(),
        ], JSON_UNESCAPED_UNICODE);

        // Générer le QR code.
        $qrCode = \tbQuar\Facades\Quar::size(200)->generate($qrData);

        return view('carte_embarquement', compact('checkIn', 'qrCode'));
    }

    /**
     * Télécharger la carte d'embarquement au format PDF.
     */
    public function downloadPdf(CheckIn $checkIn)
    {
        // Vérifier que la carte appartient à l'utilisateur connecté.
        abort_unless(
            $checkIn->reservation()
                ->where('user_id', auth()->id())
                ->exists(),
            403
        );

        // Charger toutes les informations nécessaires.
        $checkIn->load([
            'reservation',
            'passenger',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'flight.aircraft',
        ]);

        $flight = $checkIn->flight;

        // Préparer les données du QR code.
        $qrData = json_encode([
            'application' => 'FLIGHT MANAGER',
            'checkin_reference' => $checkIn->checkin_reference,
            'passenger' => $checkIn->passenger->first_name . ' ' . $checkIn->passenger->last_name,
            'flight' => $flight->flight_number,
            'seat' => $checkIn->seat_number,
            'departure' => $flight->departureAirport->code,
            'arrival' => $flight->arrivalAirport->code,
            'departure_at' => $flight->departure_at->toDateTimeString(),
        ], JSON_UNESCAPED_UNICODE);

        // Générer le QR code.
        $qrCode = \tbQuar\Facades\Quar::size(200)->generate($qrData);

        // Générer le document PDF.
        $pdf = Pdf::loadView(
            'pdf.carte_embarquement',
            compact('checkIn', 'qrCode')
        );

        // Définir le format de la page.
        $pdf->setPaper('A4', 'portrait');

        // Télécharger le fichier.
        return $pdf->download(
            'carte-embarquement-' . $checkIn->checkin_reference . '.pdf'
        );
    }
}