<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class CampusEvent extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'location',
        'category',
        'organizer',
        'max_attendees',
        'requires_rsvp',
        'contact_email',
        'image_url',
        'is_featured',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'requires_rsvp' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rsvps(): HasMany
    {
        return $this->hasMany(EventRsvp::class);
    }

    // Additional useful methods
    public function attendingRsvps(): HasMany
    {
        return $this->rsvps()->where('status', 'attending');
    }

    public function maybeRsvps(): HasMany
    {
        return $this->rsvps()->where('status', 'maybe');
    }

    public function notAttendingRsvps(): HasMany
    {
        return $this->rsvps()->where('status', 'not_attending');
    }

    public function isUpcoming(): bool
    {
        return $this->start_time > now();
    }

    public function isOngoing(): bool
    {
        return $this->start_time <= now() && $this->end_time >= now();
    }

    public function isPast(): bool
    {
        return $this->end_time < now();
    }

    public function isAtCapacity(): bool
    {
        if (!$this->max_attendees) {
            return false;
        }
        
        return $this->attendingRsvps()->count() >= $this->max_attendees;
    }

    public function getSpotsRemainingAttribute(): int
    {
        if (!$this->max_attendees) {
            return -1; // Unlimited
        }
        
        return max(0, $this->max_attendees - $this->attendingRsvps()->count());
    }

    public function getCategoryColorAttribute(): string
    {
        return match($this->category) {
            'academic' => 'blue',
            'club' => 'green',
            'sports' => 'red',
            'job_fair' => 'purple',
            'seminar' => 'indigo',
            'social' => 'pink',
            'other' => 'gray',
            default => 'gray'
        };
    }

    public function getCategoryIconAttribute(): string
    {
        return match($this->category) {
            'academic' => 'academic-cap',
            'club' => 'user-group',
            'sports' => 'trophy',
            'job_fair' => 'briefcase',
            'seminar' => 'presentation-chart-line',
            'social' => 'cake',
            'other' => 'calendar-days',
            default => 'calendar-days'
        };
    }

    // Scopes
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->where('start_time', '>', now());
    }

    public function scopePast(Builder $query): Builder
    {
        return $query->where('end_time', '<', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('organizer', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }
}
