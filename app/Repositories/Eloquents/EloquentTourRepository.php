<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\TourRepositoryInterface;
use App\Models\Tour;
use Exception;
use Date;

class EloquentTourRepository extends EloquentRepository implements TourRepositoryInterface
{
    public function getModel()
    {
        return Tour::class;
    }

    public function getByTime(Date $timeStart, Date $timeFinish)
    {
        if ($timeStart > $timeFinish) {
            throw new Exception();
        }

        return $this->model->where('time_start', '>=', $timeStart)->andWhere('timeFinish', '<=', $timeFinish);
    }
}
