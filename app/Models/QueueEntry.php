<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueEntry extends Model {
    protected $fillable = [
        'room_id','name','status',
        'joined_at','started_at','finished_at','position'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
