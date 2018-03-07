<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class Service extends Model
{
    protected $fillable = [
        'activity_date_id',
        'name',
        'content',
        'picture',
        'type',
    ];

    protected $appends = [
        'picture_path',
    ];

    public function  activityDate()
    {
        return $this->belongsTo(ActivityDate::class);
    }

    public function scopeFood($query)
    {
        return $query->where('type', 'food')->get();
    }

    public function scopePlace($query)
    {
        return $query->where('type', 'place')->get();
    }

    public function getPicturePathAttribute()
    {
        $pathFile = config('setting.service_upload_folder') . $this->attributes['picture'];
        
        if (!File::exists(public_path($pathFile)) || empty($this->attributes['picture'])) {
            if ($this->attributes['type'] == 'food') {
                return config('setting.food_default_img');
            } else {
                return config('setting.place_default_img');
            }
            
        }

        return config('setting.service_upload_folder') . $this->attributes['picture']; 
    }
}
