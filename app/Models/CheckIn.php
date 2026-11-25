<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'reservation_passenger_id',
        'flight_id',
        'checkin_reference',
        'seat_number',
        'checked_in_at',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(
            ReservationPassenger::class,
            'reservation_passenger_id'
        );
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}