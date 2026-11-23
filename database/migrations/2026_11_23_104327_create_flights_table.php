<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            $table->string('flight_number')->unique();

            $table->foreignId('departure_airport_id')
                ->constrained('airports')
                ->restrictOnDelete();

            $table->foreignId('arrival_airport_id')
                ->constrained('airports')
                ->restrictOnDelete();

            $table->foreignId('aircraft_id')
                ->nullable()
                ->constrained('aircraft')
                ->nullOnDelete();

            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');

            $table->decimal('price', 12, 2);
            $table->unsignedInteger('available_seats');

            $table->string('status')->default('scheduled');

            $table->timestamps();

            $table->index(['departure_airport_id', 'arrival_airport_id']);
            $table->index('departure_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};