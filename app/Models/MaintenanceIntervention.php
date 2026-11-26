<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceIntervention extends Model
{
    use HasFactory;

    protected $fillable = [
        'aircraft_id',
        'technician_id',
        'reference',
        'intervention_type',
        'title',
        'description',
        'status',
        'opened_at',
        'completed_at',
        'technician_report',
    ];

    protected function casts(): array
    {
        return [
            'opened_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function aircraft(): BelongsTo
    {
        return $this->belongsTo(Aircraft::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(CrewMember::class, 'technician_id');
    }
}