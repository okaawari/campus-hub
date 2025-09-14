<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumVote extends Model
{
    protected $fillable = [
        'forum_post_id',
        'user_id',
        'type',
    ];

    public function forumPost(): BelongsTo
    {
        return $this->belongsTo(ForumPost::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
