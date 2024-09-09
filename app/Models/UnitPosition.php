<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPosition extends Model
{
    protected $fillable = [
        'unit_id',
        'column_id',
        'last_moved_at',
        'call_id',
    ];

    protected $casts = [
        'last_moved_at' => 'datetime',
    ];

    // Define the relationship with the AssignmentColumn model
    public function assignmentColumn()
    {
        return $this->belongsTo(AssignmentColumn::class, 'column_id');
    }
}