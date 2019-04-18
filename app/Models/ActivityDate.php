<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class ActivityDate extends Model
{
    protected $fillable = [
        'tour_id',
        'title',
        'detail',
        'time',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
