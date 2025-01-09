<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fire extends Model
{
    use HasFactory;

    protected $fillable = [
        'call_id',
        'incident_id',
        'agency',
        'nature',
        'zone',
        'responsible_unit',
        'address',
        'city',
        'latitude',
        'longitude',
        'type',
        'status',
        'status_time',
        'callnum',
        'date',
        'assigned_units'
    ];

    protected $casts = [
        'date' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
        'assigned_units' => 'array'
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(FireAssignment::class);
    }
}
