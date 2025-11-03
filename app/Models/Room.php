<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
    'title',
    'code',
    'zoom_link',
    'start_date', // ← add this
    'start_time',
    'expected_duration_minutes',
    'avg_duration_seconds',
];

    public function entries(): HasMany {
        return $this->hasMany(QueueEntry::class);
    }
}
