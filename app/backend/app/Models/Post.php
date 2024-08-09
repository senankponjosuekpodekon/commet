<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'title',
        'link',
        'content',

        
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->BelongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
