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

    public function addNewBookingFromUser($userId, array $data, $tourId);

    public function getNewTours($limit = 0);

    public function getPopularTours($limit = 0);

    public function getToursOfCategory(array $categoriesId, $limit = 0);

    public function searchTour($urlCurrent, $keySearch, $category, $checkIn, $checkOut, $price, $limit = 0);

    public function store($data);

    public function createActiveDate($acticeDates, $tourId);

    public function update($tour, $id);

    public function updateMultiActiveDate($activeDates, $tourId);

    public function delete($tourId);

    public function getNote();

    public function getTerm();
}
