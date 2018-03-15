<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\TourInterface;
use App\Models\Tour;
use App\Models\Review;
use App\Models\Booking;
use Exception;
use Date;

class EloquentTourRepository extends EloquentRepository implements TourInterface
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

    public function getRate($id, array $data)
    {
        $tour = $this->getById($id);
        $number = 0;
        $data['food_rate'] = 0;
        $data['place_rate'] = 0;
        $data['service_rate'] = 0;
        $data['total_rate'] = 0;

        foreach ($tour->reviews as $review) {
            $data['food_rate'] += $review->food_rate;
            $data['place_rate'] += $review->place_rate;
            $data['service_rate'] += $review->service_rate;
            $data['total_rate'] += $review->total_rate;
            $number++;
        }

        if ($number) {
            $data['food_rate'] /= $number;
            $data['place_rate'] /= $number;
            $data['service_rate'] /= $number;
            $data['total_rate'] = round($data['total_rate'] / $number, 1);
        }

        return $data;
    }

    public function getReviews(Tour $tour)
    {
        return $tour->reviews()->orderBy('created_at', 'desc')->paginate(5);
    }

    public function addNewReviewFromUser($userId, array $data)
    {
        $data['user_id'] = $userId;

        return Review::create($data);
    }

    public function addNewBookingFromUser($userId, array $data)
    {
        $data['user_id'] = $userId;

        return Booking::create($data);
    }

    public function getNewTours($limit = 0)
    {
        return $this->model->orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public function getPopularTours($limit = 0)
    {
        return $this->model->withCount('bookings')->orderBy('bookings_count', 'desc')->limit($limit)->get();
    }

    public function getToursOfCategory(array $categoriesId, $limit = 0)
    {
        return $this->model->whereIn('category_id', $categoriesId)->inRandomOrder()->limit($limit)->get();
    }
}
