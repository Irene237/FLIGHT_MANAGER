<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
class CrewMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'license_number',
        'hire_date',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function assignments(): HasMany
{
    return $this->hasMany(CrewAssignment::class);
}

public function maintenanceInterventions(): HasMany
{
    return $this->hasMany(
        MaintenanceIntervention::class,
        'technician_id'
    );
}
}