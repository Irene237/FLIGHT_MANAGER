<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_interventions', function (Blueprint $table) {
            $table->id();

            // Avion concerné
            $table->foreignId('aircraft_id')
                ->constrained('aircraft')
                ->restrictOnDelete();

            // Technicien responsable
            $table->foreignId('technician_id')
                ->constrained('crew_members')
                ->restrictOnDelete();

            // Informations sur le problème
            $table->string('reference')->unique();

            $table->enum('intervention_type', [
                'inspection',
                'repair',
                'maintenance',
                'emergency'
            ]);

            $table->string('title');
            $table->text('description');

            // Suivi de l'intervention
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('pending');

            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('completed_at')->nullable();

            $table->text('technician_report')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_interventions');
    }
};