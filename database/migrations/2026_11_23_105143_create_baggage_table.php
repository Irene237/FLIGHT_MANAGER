<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baggage', function (Blueprint $table) {
            $table->id();

            $table->string('tag_number')->unique();

            $table->foreignId('reservation_id')
                ->constrained('reservations')
                ->cascadeOnDelete();

            $table->foreignId('reservation_passenger_id')
                ->nullable()
                ->constrained('reservation_passengers')
                ->nullOnDelete();

            $table->decimal('weight', 6, 2);

            $table->string('type')->default('checked');

            $table->string('status')->default('registered');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baggage');
    }
};