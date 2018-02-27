<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'activity_date_id',
        'name',
        'content',
        'picture',
        'type',
    ];

    public function  activityDate()
    {
        return $this->belongsTo(ActivityDate::class);
    }
}
