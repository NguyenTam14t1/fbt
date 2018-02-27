<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'place',
        'hotel',
        'time_start',
        'time_finish',
        'participants_min',
        'participants_max',
        'price',
        'picture',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function newses()
    {
        return $this->hasMany(News::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function activityDates()
    {
        return $this->hasMany(ActivityDate::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}   
