<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_number',
        'departure_airport_id',
        'arrival_airport_id',
        'aircraft_id',
        'departure_at',
        'arrival_at',
        'price',
        'available_seats',
        'status',
    ];

    protected $casts = [
        'departure_at' => 'datetime',
        'arrival_at' => 'datetime',
        'price' => 'decimal:2',
        'available_seats' => 'integer',
    ];

    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function aircraft(): BelongsTo
    {
        return $this->belongsTo(Aircraft::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Les enregistrements en ligne du vol.
     */
    public function checkIns(): HasMany
    {
        return $this->hasMany(CheckIn::class);
    }
}