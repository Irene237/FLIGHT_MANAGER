<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Réservation concernée
            $table->foreignId('reservation_id')
                ->constrained('reservations')
                ->cascadeOnDelete();

            // Référence unique de transaction
            $table->string('transaction_reference')->unique();

            // Moyen de paiement
            $table->enum('payment_method', [
                'mtn_mobile_money',
                'orange_money',
                'bank_card'
            ]);

            // Montant payé
            $table->decimal('amount', 12, 2);

            // Statut du paiement simulé
            $table->enum('status', [
                'pending',
                'successful',
                'failed'
            ])->default('pending');

            // Date de confirmation
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index(['reservation_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};