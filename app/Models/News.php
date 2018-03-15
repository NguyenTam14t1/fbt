<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;
use Carbon\Carbon;

class News extends Model
{
    protected $fillable = [
        'tour_id',
        'title',
        'content',
        'picture',
    ];

    protected $appends = [
        'picture_path',
        'created_time',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getPicturePathAttribute()
    {
        $pathFile = config('setting.news_upload_folder') . $this->attributes['picture'];
        
        if (!File::exists(public_path($pathFile)) || empty($this->attributes['picture'])) {
            return config('setting.news_default_img');
        }

        return config('setting.news_upload_folder') . $this->attributes['picture']; 
    }

    public function getCreatedTimeAttribute() {
        return Carbon::parse($this->attributes['updated_at'])->format('F j, Y');
    }
}
