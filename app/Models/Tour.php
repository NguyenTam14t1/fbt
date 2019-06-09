<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File;
use Storage;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tour extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'place' => 10,
            'name' => 10,
            'description' => 10,
        ],
    ];

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'place',
        'time_start',
        'time_finish',
        'participants_min',
        'participants_max',
        'price',
        'thumbnail',
        'name_thumbnail',
        'count_register',
    ];

    protected $appends = [
        'time_start_format',
        'time_finish_format',
        'price_child',
        'picture_path',
        'rate',
        'seat_available',
        'duration',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'tour_hotel', 'tour_id', 'hotel_id');
    }

    public function guides()
    {
        return $this->belongsToMany(Guide::class, 'tour_guide', 'tour_id', 'guide_id');
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
            $pathFile = Storage::path(config('images.paths.thumbnail_tour') . '/' . $this->attributes['thumbnail']);
            // return $pathFile;
            // return '/storage/app/' . config('images.paths.thumbnail_tour') . '/' . $this->attributes['thumbnail'];
            return '/storage/' . config('images.paths.thumbnail_tour') . '/' . $this->attributes['thumbnail'];
        }

        return config('setting.tour_default_img');

        // if (!empty($this->attributes['thumbnail'])) {
        //     $pathFile = config('images.paths.thumbnail_tour') . '/' . $this->attributes['thumbnail'];

        //     return full_path_file($pathFile);
        // }

        // return config('setting.tour_default_img');
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

    // public function setDescriptionAttribute($value)
    // {
    //     // return $this->sanitize($value);
    //     return strip_tags($value);
    // }

    public function getDescriptionAttribute($value)
    {
        return strip_tags($value);
    }

    public function getSeatAvailableAttribute()
    {
        return $this->participants_max - $this->count_register;
    }

    public function getDurationAttribute()
    {
        $startDay = Carbon::parse($this->attributes['time_start']);
        $endDay = Carbon::parse($this->attributes['time_finish']);
        $duration = ($endDay->diffInDays($startDay)) + 1;

        return $duration;
    }
}
