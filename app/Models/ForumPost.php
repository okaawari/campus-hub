<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumPost extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'title',
        'content',
        'category',
        'subject',
        'course_code',
        'views',
        'upvotes',
        'is_solved',
        'is_pinned',
    ];

    protected $casts = [
        'is_solved' => 'boolean',
        'is_pinned' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ForumPost::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ForumPost::class, 'parent_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(ForumVote::class);
    }
}
