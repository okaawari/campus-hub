<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TutorBooking extends Model
{
    protected $fillable = [
        'tutor_id',
        'student_id',
        'scheduled_time',
        'duration_minutes',
        'total_cost',
        'status',
        'notes',
        'meeting_link',
    ];

    protected $casts = [
        'scheduled_time' => 'datetime',
        'total_cost' => 'decimal:2',
    ];

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
