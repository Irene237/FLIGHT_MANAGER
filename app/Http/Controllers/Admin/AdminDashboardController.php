<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Nombre de vols programmés à venir
        $totalFlights = DB::table('flights')
            ->where('status', 'scheduled')
            ->where('departure_at', '>=', now())
            ->count();

        // 2. Nombre total de réservations
        $totalReservations = DB::table('reservations')->count();

        // 3. Nombre total de passagers enregistrés
        $totalPassengers = DB::table('reservation_passengers')->count();

        // 4. Revenus provenant des paiements réussis
        $totalRevenue = DB::table('payments')
            ->where('status', 'successful')
            ->sum('amount');

        // 5. Diagramme dynamique des réservations sur 7 jours
        $activityDays = collect();

        $dailyCounts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $count = DB::table('reservations')
                ->whereDate('reserved_at', $date->toDateString())
                ->count();

            $dailyCounts[] = [
                'date' => $date,
                'count' => $count,
            ];
        }

        $maxReservations = max(
            array_column($dailyCounts, 'count') ?: [0]
        );

        $dayNames = [
            'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'
        ];

        foreach ($dailyCounts as $item) {
            $activityDays->push([
                'day' => $dayNames[$item['date']->dayOfWeek],
                'date' => $item['date']->format('d/m'),
                'count' => $item['count'],
                'pct' => $maxReservations > 0
                    ? ($item['count'] / $maxReservations) * 100
                    : 0,
            ]);
        }

        // 6. Les cinq dernières réservations
        $recentReservations = DB::table('reservations')
            ->join('users', 'reservations.user_id', '=', 'users.id')
            ->join('flights', 'reservations.flight_id', '=', 'flights.id')
            ->join('airports as departure', 'flights.departure_airport_id', '=', 'departure.id')
            ->join('airports as arrival', 'flights.arrival_airport_id', '=', 'arrival.id')
            ->select(
                'reservations.reference',
                'reservations.status',
                'reservations.total_amount',
                'reservations.reserved_at',
                'users.name as client_name',
                'flights.flight_number',
                'departure.code as departure_code',
                'arrival.code as arrival_code'
            )
            ->orderByDesc('reservations.reserved_at')
            ->limit(5)
            ->get();

        // 7. Avions indisponibles
        $unavailableAircraft = DB::table('aircraft')
            ->where('status', '!=', 'available')
            ->count();

        // 8. Bagages nécessitant une attention
        $baggageIssues = DB::table('baggage')
            ->whereNotIn('status', ['registered'])
            ->count();

        return view('admin.dashboard', compact(
            'totalFlights',
            'totalReservations',
            'totalPassengers',
            'totalRevenue',
            'activityDays',
            'recentReservations',
            'unavailableAircraft',
            'baggageIssues'
        ));
    }
}