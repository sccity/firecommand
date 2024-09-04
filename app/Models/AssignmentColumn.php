<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentColumn extends Model
{
    protected $fillable = ['call_id', 'columns'];

    protected $casts = [
        'columns' => 'array',
    ];
}