<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reservation_id')
                ->constrained('reservations')
                ->cascadeOnDelete();

            $table->foreignId('reservation_passenger_id')
                ->constrained('reservation_passengers')
                ->cascadeOnDelete();

            $table->foreignId('flight_id')
                ->constrained('flights')
                ->restrictOnDelete();

            $table->string('checkin_reference')->unique();

            $table->string('seat_number');

            $table->dateTime('checked_in_at');

            $table->timestamps();

            // Un passager ne peut être enregistré qu'une fois par réservation.
            $table->unique(
                ['reservation_id', 'reservation_passenger_id'],
                'checkins_reservation_passenger_unique'
            );

            // Deux passagers ne peuvent pas occuper le même siège sur un vol.
            $table->unique(
                ['flight_id', 'seat_number'],
                'checkins_flight_seat_unique'
            );

            $table->index('flight_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
};