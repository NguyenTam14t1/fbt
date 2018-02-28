<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimesPayment extends Model
{
    protected $fillable = [
        'booking_id',
        'cash',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
