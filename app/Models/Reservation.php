<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'flight_id',
        'total_amount',
        'number_of_seats',
        'status',
        'reserved_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'number_of_seats' => 'integer',
        'reserved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    public function passengers(): HasMany
    {
        return $this->hasMany(ReservationPassenger::class);
    }

    public function baggage(): HasMany
    {
        return $this->hasMany(Baggage::class);
    }

    /**
     * Une réservation peut avoir plusieurs paiements.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}