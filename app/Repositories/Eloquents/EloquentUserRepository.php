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

    public function getBookingsPaginate(User $user, $status, $limit = 0)
    {
        if ($status > config('setting.booking_finished')) {
            return $user->bookings()->paginate($limit);
        }

        return $user->bookings()->where('status', $status)->orderBy('updated_at', 'desc')->paginate($limit);
    }

    public function findOrFail($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function update($input, $id)
    {
        try {
            $guide = $this->model->findOrFail($id);

            $guide->update($input);

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
