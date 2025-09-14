<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'hourly_rate',
        'availability',
        'location',
        'rating',
        'total_sessions',
        'offers_free_session',
        'qualifications',
        'is_available',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'availability' => 'array',
        'rating' => 'decimal:2',
        'offers_free_session' => 'boolean',
        'is_available' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(TutorBooking::class);
    }
}
