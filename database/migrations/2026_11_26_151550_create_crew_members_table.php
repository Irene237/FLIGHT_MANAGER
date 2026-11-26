<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crew_members', function (Blueprint $table) {
            $table->id();

            // Identification professionnelle
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('last_name');

            // Coordonnées
            $table->string('email')->unique();
            $table->string('phone');

            // Fonction dans l'équipage
            $table->enum('role', [
                'captain',
                'first_officer',
                'flight_attendant',
                'chief_flight_attendant',
                'technician'
            ]);

            // Informations professionnelles
            $table->string('license_number')->nullable();
            $table->date('hire_date')->nullable();

            // Disponibilité professionnelle
            $table->enum('status', [
                'active',
                'inactive',
                'on_leave',
                'suspended'
            ])->default('active');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crew_members');
    }
};