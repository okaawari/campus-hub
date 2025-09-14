<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyMaterial extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'subject',
        'course_code',
        'professor',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'type',
        'rating',
        'downloads',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'is_approved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(StudyMaterialRating::class);
    }
}
