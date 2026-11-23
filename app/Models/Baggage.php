<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baggage extends Model
{
    use HasFactory;

    protected $table = 'baggage';

    protected $fillable = [
        'tag_number',
        'reservation_id',
        'reservation_passenger_id',
        'weight',
        'type',
        'status',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
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
}