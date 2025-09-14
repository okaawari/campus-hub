<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Textbook extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'author',
        'isbn',
        'edition',
        'description',
        'condition',
        'price',
        'listing_type',
        'course_code',
        'subject',
        'images',
        'location',
        'is_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'images' => 'array',
        'is_available' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the user can update the textbook.
     */
    public function canUpdate($user): bool
    {
        return $this->user_id === $user->id;
    }

    /**
     * Check if the user can delete the textbook.
     */
    public function canDelete($user): bool
    {
        return $this->user_id === $user->id;
    }
}
