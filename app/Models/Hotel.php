<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'address',
        'information',
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_hotel', 'hotel_id', 'tour_id');
    }
}
