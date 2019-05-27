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

    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->withTrashed()->get();
    }

    public function getBookingByConfirm($confirm)
    {
        return Booking::where('confirm_code', $confirm);
    }

    public function delete($bookingId)
    {
        try {
            $booking = $this->model->withTrashed()->findOrFail($bookingId);

            if ($booking->deleted_at) {
                $data['status'] = config('setting.booking_wait_confirm');
                $booking->update($data);
                $booking->restore();

                return 'Booking enable success!';
            } else {
                $data['status'] = config('setting.booking_cancel');
                $booking->update($data);
                $booking->delete();

                return 'Booking disable success!';
            }

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function findOrFail($id)
    {
        try {

            return $this->model->withTrashed()
                ->with(['user'])
                ->findOrFail($id);
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
