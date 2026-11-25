<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReservationPassenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'passport_number',
        'nationality',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function baggage(): HasMany
    {
        return $this->hasMany(Baggage::class);
    }

    /**
     * Les enregistrements en ligne du passager.
     */
    public function checkIns(): HasMany
    {
        return $this->hasMany(CheckIn::class);
    }
}