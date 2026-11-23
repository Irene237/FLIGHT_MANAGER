<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Aircraft;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $flights = [
            [
                'flight_number' => 'FM001',
                'departure' => 'DLA',
                'arrival' => 'CDG',
                'aircraft' => 'TJ-AIR-003',
                'departure_at' => '2026-12-15 08:00:00',
                'arrival_at' => '2026-12-15 17:00:00',
                'price' => 350000,
                'available_seats' => 150,
                'status' => 'scheduled',
            ],
            [
                'flight_number' => 'FM002',
                'departure' => 'NSI',
                'arrival' => 'DKR',
                'aircraft' => 'TJ-AIR-001',
                'departure_at' => '2026-12-17 10:00:00',
                'arrival_at' => '2026-12-17 13:00:00',
                'price' => 180000,
                'available_seats' => 120,
                'status' => 'scheduled',
            ],
            [
                'flight_number' => 'FM003',
                'departure' => 'DLA',
                'arrival' => 'DXB',
                'aircraft' => 'TJ-AIR-002',
                'departure_at' => '2026-12-20 09:00:00',
                'arrival_at' => '2026-12-20 17:00:00',
                'price' => 420000,
                'available_seats' => 140,
                'status' => 'scheduled',
            ],
            [
                'flight_number' => 'FM004',
                'departure' => 'ABJ',
                'arrival' => 'NSI',
                'aircraft' => 'TJ-AIR-001',
                'departure_at' => '2026-12-22 14:00:00',
                'arrival_at' => '2026-12-22 17:00:00',
                'price' => 160000,
                'available_seats' => 100,
                'status' => 'scheduled',
            ],
        ];

        foreach ($flights as $data) {
            $departureAirport = Airport::where('code', $data['departure'])->firstOrFail();
            $arrivalAirport = Airport::where('code', $data['arrival'])->firstOrFail();
            $aircraft = Aircraft::where('registration_number', $data['aircraft'])->firstOrFail();

            Flight::updateOrCreate(
                ['flight_number' => $data['flight_number']],
                [
                    'departure_airport_id' => $departureAirport->id,
                    'arrival_airport_id' => $arrivalAirport->id,
                    'aircraft_id' => $aircraft->id,
                    'departure_at' => $data['departure_at'],
                    'arrival_at' => $data['arrival_at'],
                    'price' => $data['price'],
                    'available_seats' => min($data['available_seats'], $aircraft->capacity),
                    'status' => $data['status'],
                ]
            );
        }
    }
}
