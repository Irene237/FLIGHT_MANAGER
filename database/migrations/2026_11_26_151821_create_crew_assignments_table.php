<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crew_assignments', function (Blueprint $table) {
            $table->id();

            // Membre d'équipage affecté
            $table->foreignId('crew_member_id')
                ->constrained('crew_members')
                ->cascadeOnDelete();

            // Vol concerné
            $table->foreignId('flight_id')
                ->constrained('flights')
                ->cascadeOnDelete();

            // Fonction exercée pendant le vol
            $table->enum('assignment_role', [
                'captain',
                'first_officer',
                'flight_attendant',
                'chief_flight_attendant'
            ]);

            // État de l'affectation
            $table->enum('status', [
                'assigned',
                'confirmed',
                'completed',
                'cancelled'
            ])->default('assigned');

            $table->timestamp('assigned_at')->useCurrent();

            $table->text('notes')->nullable();

            $table->timestamps();

            // Un même membre ne peut pas être affecté deux fois
            // au même vol.
            $table->unique(
                ['crew_member_id', 'flight_id'],
                'crew_member_flight_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crew_assignments');
    }
};