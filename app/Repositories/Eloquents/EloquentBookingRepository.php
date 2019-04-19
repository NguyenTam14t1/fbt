<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\BookingInterface;
use App\Models\Booking;
use App\Models\User;
use Exception;

class EloquentBookingRepository extends EloquentRepository implements BookingInterface
{
    public function getModel()
    {
        return Booking::class;
    }

    public function getBookingByConfirm($confirm)
    {
        return Booking::where('confirm_code', $confirm);
    }
}
