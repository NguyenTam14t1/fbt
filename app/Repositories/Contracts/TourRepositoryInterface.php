<?php

namespace App\Repositories\Contracts;

use Date;

interface TourRepositoryInterface
{
    public function getByTime(Date $timeStart, Date $timeFinish);
}
