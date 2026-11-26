<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReservationController extends Controller
{
    /**
     * Construire la requête commune aux filtres.
     */
    private function reservationQuery(Request $request)
    {
        $query = Reservation::with([
            'user',
            'passengers',
            'flight.departureAirport',
            'flight.arrivalAirport',
            'payments'
        ]);

        // Recherche par référence.
        if ($request->filled('reference')) {
            $query->where(
                'reference',
                'like',
                '%' . $request->reference . '%'
            );
        }

        // Recherche par nom du passager ou du client.
        if ($request->filled('passenger')) {
            $search = $request->passenger;

            $query->where(function ($q) use ($search) {
                $q->whereHas('passengers', function ($passengerQuery) use ($search) {
                    $passengerQuery->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        // Recherche par date du vol.
        if ($request->filled('flight_date')) {
            $query->whereHas('flight', function ($flightQuery) use ($request) {
                $flightQuery->whereDate(
                    'departure_at',
                    $request->flight_date
                );
            });
        }

        // Filtrage par statut.
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    /**
     * Afficher la liste des réservations.
     */
    public function index(Request $request)
    {
        $reservations = $this->reservationQuery($request)
            ->orderBy('reserved_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Statistiques générales.
        $totalReservations = Reservation::count();

        $confirmedReservations = Reservation::where('status', 'confirmed')->count();

        $pendingReservations = Reservation::where('status', 'pending')->count();

        $cancelledReservations = Reservation::where('status', 'cancelled')->count();

        // Revenus réellement encaissés.
        $totalRevenue = Payment::where('status', 'successful')->sum('amount');

        return view('admin.reservations.index', compact(
            'reservations',
            'totalReservations',
            'confirmedReservations',
            'pendingReservations',
            'cancelledReservations',
            'totalRevenue'
        ));
    }

    /**
     * Exporter les réservations au format PDF.
     */
    public function exportPdf(Request $request)
    {
        $reservations = $this->reservationQuery($request)
            ->orderBy('reserved_at', 'desc')
            ->get();

        $pdf = Pdf::loadView(
            'admin.reservations.pdf',
            compact('reservations')
        )->setPaper('a4', 'landscape');

        return $pdf->download('reservations-flight-manager.pdf');
    }
}