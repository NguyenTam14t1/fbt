<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'booking_id',
        'full_name',
        'date_born',
        'type_guest',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
