<?php

namespace App\Repositories\Contracts;

use Date;
use App\Models\Tour;

interface TourInterface
{
    public function getByTime(Date $timeStart, Date $timeFinish);

    public function getRate($id, array $data);

    public function getReviews(Tour $tour);

    public function addNewReviewFromUser($userId, array $data);
}
