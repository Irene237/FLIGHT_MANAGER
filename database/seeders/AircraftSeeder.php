<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aircraft;

class AircraftSeeder extends Seeder
{
    public function run(): void
    {
        $aircrafts = [
            [
                'registration_number' => 'TJ-AIR-001',
                'model' => 'Boeing 737-800',
                'manufacturer' => 'Boeing',
                'capacity' => 189,
                'status' => 'available',
            ],
            [
                'registration_number' => 'TJ-AIR-002',
                'model' => 'Airbus A320',
                'manufacturer' => 'Airbus',
                'capacity' => 180,
                'status' => 'available',
            ],
            [
                'registration_number' => 'TJ-AIR-003',
                'model' => 'Boeing 787-9 Dreamliner',
                'manufacturer' => 'Boeing',
                'capacity' => 296,
                'status' => 'available',
            ],
        ];

        foreach ($aircrafts as $aircraft) {
            Aircraft::updateOrCreate(
                ['registration_number' => $aircraft['registration_number']],
                $aircraft
            );
        }
    }
}
