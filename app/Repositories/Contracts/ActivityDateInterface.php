<?php

namespace App\Repositories\Contracts;

use App\Models\ActivityDate;

interface ActivityDateInterface
{
    public function store($data, $tourId);
}
