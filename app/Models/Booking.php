<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'number_of_people',
        'status',
        'paymented',
        'debt',
        'times_payment',
    ];

    public function timesPayments()
    {
        return $this->hasMany(TimesPayment::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
