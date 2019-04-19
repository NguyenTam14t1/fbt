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
        'status_text',
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

    public function getStatusTextAttribute() {
        switch ($this->attributes['status']) {
            case config('setting.booking_cancel'):
                return trans('lang.canceled');
                break;
            case config('setting.booking_wait_confirm'):
                return trans('lang.waiting');
                break;
            case config('setting.booking_confirmed'):
                return trans('lang.confirmed');
                break;
            case config('setting.booking_paymented'):
                return trans('lang.paymented');
                break;
            case config('setting.booking_finished'):
                return trans('lang.finished');
                break;
            default:
                return false;
                break;
        }
    }
}
