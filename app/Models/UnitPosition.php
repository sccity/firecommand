<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPosition extends Model
{
    protected $fillable = [
        'unit_name',
        'column_name',
        'last_moved_at',
        'call_id',
    ];
    protected $casts = [
        'last_moved_at' => 'datetime',
    ];
}