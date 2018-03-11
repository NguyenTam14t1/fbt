<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'first_name',
        'last_name',
        'address',
        'phone',
        'identity_card',
        'requiments',
        'number_of_people',
        'number_of_children',
        'status',
        'paymented',
        'debt',
        'times_payment',
        'confirm_code',
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
