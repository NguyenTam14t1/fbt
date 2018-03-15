<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\UserInterface;
use App\Models\User;
use App\Models\Booking;

class EloquentUserRepository extends EloquentRepository implements UserInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getBookings(User $user, $status)
    {
        return $user->bookings()->Where('status', $status);
    }

    public function getBookingsRecent(User $user, $limit = 10)
    {
        return $user->bookings()->orderBy('updated_at', 'desc')->limit($limit);
    }
}
