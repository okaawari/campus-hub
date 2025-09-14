<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventRsvp extends Model
{
    protected $fillable = [
        'campus_event_id',
        'user_id',
        'status',
        'notes',
    ];

    public function campusEvent(): BelongsTo
    {
        return $this->belongsTo(CampusEvent::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
