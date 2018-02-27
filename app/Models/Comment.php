<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'content',
        'parent_id',
        'commentable_id',
        'commentable_type',
    ];

    public function subComments()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
