<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            [
                'code' => 'DLA',
                'name' => 'Aéroport international de Douala',
                'city' => 'Douala',
                'country' => 'Cameroun',
                'address' => 'Douala, Cameroun',
                'is_active' => true,
            ],
            [
                'code' => 'NSI',
                'name' => 'Aéroport international de Yaoundé-Nsimalen',
                'city' => 'Yaoundé',
                'country' => 'Cameroun',
                'address' => 'Nsimalen, Yaoundé',
                'is_active' => true,
            ],
            [
                'code' => 'CDG',
                'name' => 'Aéroport Paris-Charles-de-Gaulle',
                'city' => 'Paris',
                'country' => 'France',
                'address' => 'Roissy-en-France, France',
                'is_active' => true,
            ],
            [
                'code' => 'DXB',
                'name' => 'Aéroport international de Dubaï',
                'city' => 'Dubaï',
                'country' => 'Émirats arabes unis',
                'address' => 'Dubaï, Émirats arabes unis',
                'is_active' => true,
            ],
            [
                'code' => 'DKR',
                'name' => 'Aéroport international Blaise-Diagne',
                'city' => 'Dakar',
                'country' => 'Sénégal',
                'address' => 'Diass, Sénégal',
                'is_active' => true,
            ],
            [
                'code' => 'JFK',
                'name' => 'Aéroport international John F. Kennedy',
                'city' => 'New York',
                'country' => 'États-Unis',
                'address' => 'Queens, New York',
                'is_active' => true,
            ],
            [
                'code' => 'ABJ',
                'name' => 'Aéroport international Félix-Houphouët-Boigny',
                'city' => 'Abidjan',
                'country' => 'Côte d’Ivoire',
                'address' => 'Port-Bouët, Abidjan',
                'is_active' => true,
            ],
        ];

        foreach ($airports as $airport) {
            Airport::updateOrCreate(
                ['code' => $airport['code']],
                $airport
            );
        }
    }
}
