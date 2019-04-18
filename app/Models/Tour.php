<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use Storage;

class Tour extends Model
{
    protected $fillable = [
        'category_id',
        'hotel_id',
        'guide_id',
        'name',
        'description',
        'place',
        'time_start',
        'time_finish',
        'participants_min',
        'participants_max',
        'price',
        'thumbnail',
    ];

    protected $appends = [
        'time_start_format',
        'time_finish_format',
        'price_child',
        'picture_path',
        'rate',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function guides()
    {
        return $this->hasMany(Guide::class);
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

    public function getTimeStartFormatAttribute() {
        return Carbon::parse($this->attributes['time_start'])->format('d/m/Y');
    }

    public function getTimeFinishFormatAttribute() {
        return Carbon::parse($this->attributes['time_finish'])->format('d/m/Y');
    }

    public function getPriceChildAttribute() {
        $price_child = floor($this->attributes['price'] / 2);
        
        return $price_child;
    }    

    public function getPicturePathAttribute()
    {
        if (!empty($this->attributes['thumbnail'])) {
            // $pathFile = Storage::path(config('images.paths.thumbnail_tour') . '/' . $this->attributes['thumbnail']);
            // return $pathFile;
            return '/storage/app/' . config('images.paths.thumbnail_tour') . '/' . $this->attributes['thumbnail'];
        }

        return config('setting.tour_default_img');
    }

    public function getRateAttribute()
    {
        $tour = $this->find($this->attributes['id']);
        $rate = 0;

        foreach ($tour->reviews as $review) {
            $rate += $review->total_rate;
        }

        if ($rate) {
            $rate /= count($tour->reviews);
        }

        return $rate;
    }
}   
