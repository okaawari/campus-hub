<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'workos_id',
        'avatar',
        'phone',
        'bio',
        'university',
        'major',
        'year_of_study',
        'graduation_year',
        'location',
        'interests',
        'social_links',
        'preferred_contact',
        'profile_visibility',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'workos_id',
        'remember_token',
    ];

    /**
     * Get the user's initials.
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'interests' => 'array',
            'social_links' => 'array',
            'profile_visibility' => 'boolean',
            'last_active_at' => 'datetime',
        ];
    }

    // Campus Hub Relationships
    public function studyMaterials(): HasMany
    {
        return $this->hasMany(StudyMaterial::class);
    }

    public function tutorProfile(): HasMany
    {
        return $this->hasMany(Tutor::class);
    }

    public function textbooks(): HasMany
    {
        return $this->hasMany(Textbook::class);
    }

    public function campusEvents(): HasMany
    {
        return $this->hasMany(CampusEvent::class);
    }

    public function forumPosts(): HasMany
    {
        return $this->hasMany(ForumPost::class);
    }

    public function tutorBookings(): HasMany
    {
        return $this->hasMany(TutorBooking::class, 'student_id');
    }

    public function eventRsvps(): HasMany
    {
        return $this->hasMany(EventRsvp::class);
    }

    public function studyMaterialRatings(): HasMany
    {
        return $this->hasMany(StudyMaterialRating::class);
    }

    public function forumVotes(): HasMany
    {
        return $this->hasMany(ForumVote::class);
    }
}
