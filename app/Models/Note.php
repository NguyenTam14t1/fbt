<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'content',
        'type',
    ];

    public function getContentAttribute($value)
    {
        return strip_tags($value);
    }
}
