<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrewAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'crew_member_id',
        'flight_id',
        'assignment_role',
        'status',
        'assigned_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
        ];
    }

    public function crewMember(): BelongsTo
    {
        return $this->belongsTo(CrewMember::class);
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }
}