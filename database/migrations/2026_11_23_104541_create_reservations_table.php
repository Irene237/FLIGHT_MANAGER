<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('flight_id')
                ->constrained('flights')
                ->restrictOnDelete();

            $table->decimal('total_amount', 12, 2);

            $table->unsignedInteger('number_of_seats')->default(1);

            $table->string('status')->default('pending');

            $table->dateTime('reserved_at');

            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};