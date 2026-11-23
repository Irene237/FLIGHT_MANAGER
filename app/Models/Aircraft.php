<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aircraft extends Model
{
    use HasFactory;

    protected $table = 'aircraft';

    protected $fillable = [
        'registration_number',
        'model',
        'manufacturer',
        'capacity',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    // Tous les vols effectués par cet avion
    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }
}