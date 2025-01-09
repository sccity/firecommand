<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FireAssignment extends Model
{
    protected $fillable = [
        'fire_id',
        'unit',
        'position',
        'assignment_time'
    ];

    protected $casts = [
        'assignment_time' => 'datetime'
    ];

    public function fire(): BelongsTo
    {
        return $this->belongsTo(Fire::class);
    }
}
