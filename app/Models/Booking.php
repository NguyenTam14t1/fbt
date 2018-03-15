<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $appends = [
        'updated_time',
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

    public function getUpdatedTimeAttribute() {
        return Carbon::parse($this->attributes['updated_at'])->format('l\, F j, Y');
    }
}
