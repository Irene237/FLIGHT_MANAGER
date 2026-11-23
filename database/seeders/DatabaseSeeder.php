<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Insertion des aéroports
        $this->call(AirportSeeder::class);

        // Insertion des avions
        $this->call(AircraftSeeder::class);

        // Insertion des vols
        $this->call(FlightSeeder::class);
    }
}