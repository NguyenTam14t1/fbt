<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityDate extends Model
{
    protected $fillable = [
        'tour_id',
        'content',
        'picture',
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
