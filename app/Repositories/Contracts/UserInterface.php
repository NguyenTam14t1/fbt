<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserInterface {
    public function getBookings(User $user, $status);

    public function getBookingsRecent(User $user, $limit = 10);

    public function getBookingsPaginate(User $user, $status, $limit = 0);
}
