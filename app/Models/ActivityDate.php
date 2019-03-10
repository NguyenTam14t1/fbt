<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class ActivityDate extends Model
{
    protected $fillable = [
        'tour_id',
        'content',
        'picture',
    ];

    protected $appends = [
        'picture_path',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getPicturePathAttribute()
    {
        $pathFile = config('setting.date_upload_folder') . $this->attributes['picture'];

        if (!File::exists(public_path($pathFile)) || empty($this->attributes['picture'])) {
            return config('setting.date_default_img');
        }

        return config('setting.date_upload_folder') . $this->attributes['picture'];
    }
}
