<?php

namespace App\Repositories\Contracts;

use App\Model\User;

interface BookingInterface {
    public function getBookingByConfirm($confirm);

    public function delete($bookingid);
}
