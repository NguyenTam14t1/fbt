<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Repositories\Contracts\BookingInterface;
use Mail;

trait ProcessOnClient 
{
    public function updateBookingByTime(BookingInterface $bookingRepository)
    {
        $bookings = $bookingRepository->getAll();
        
        foreach ($bookings as $booking) {
            $time_start_tour = new Carbon($booking->tour->time_start);
            $deadline = $time_start_tour->subMinutes(config('setting.deadline_booking_minutes'));            
            $time_now = Carbon::now();
            $time_start_tour = new Carbon($booking->tour->time_start);
            $data = [];
            
            if ($deadline->lte($time_now) && $booking->status < 3) {
                $data['status'] = config('setting.booking_cancel');
            } elseif ($time_start_tour->lte($time_now) && $booking->status == config('setting.booking_paymented')) {
                $data['status'] = config('setting.booking_finished');
            }
            
            $bookingRepository->update($booking->id, $data);
        }

    }

    public function sendingMail(array $data, $mailTo) {
        $mData['data'] = $data;
        
        Mail::send('bookingtour.mail-form', $mData, function($message) use ($mailTo) {
            $message->to($mailTo, 'Guest');
            $message->subject('Booking Tour Request Confirmation');
            $message->from(config('mail.username'),'Travel Tour');
        });
    }
}
