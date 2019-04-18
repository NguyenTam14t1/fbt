<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\TourInterface;
use App\Models\Tour;
use App\Models\Review;
use App\Models\Booking;
use Exception;
use Date;
use DB;
use App\Repositories\Helpers\ImageHelper;

class EloquentTourRepository extends EloquentRepository implements TourInterface
{
    public function getModel()
    {
        return Tour::class;
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->get();
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

    public function searchTour($category, $checkIn, $checkOut, $price, $limit = 0)
    {
        $query = $this->model;

        if ($category) {
            $query = $query->where('category_id', $category);
        }

        if ($checkIn) {
            $query = $query->where('time_start', '>=', $checkIn);
        }

        if ($checkOut) {
            $query = $query->where('time_finish', '<=', $checkOut);
        }

        switch ($price) {
            case config('setting.price_search_1_val'):
                $query = $query->where('price', '<', 500);
                break;
            case config('setting.price_search_2_val'):
                $query = $query->whereBetween('price', [500, 1000]);
                break;
            case config('setting.price_search_3_val'):
                $query = $query->whereBetween('price', [1000, 2000]);
                break;
            case config('setting.price_search_4_val'):
                $query = $query->where('price', '>', 2000);
                break;
        }

        return $query->paginate($limit);
    }

    public function store($data)
    {
        try {
            DB::beginTransaction();
            $dataTour = array_except($data, [
                'guide_id',
                'hotel_id',
                'thumbnail',
                'activity_dates',
            ]);

            $type = 'thumbnail_tour';
            if (isset($data['thumbnail'])) {
                $dataTour['thumbnail'] = ImageHelper::uploadFile($data['thumbnail'], $type, config('images.paths.' .$type));
            }

            $tour = $this->model->create($dataTour);
// dd($tour);
//             if (isset($data['hotel_id'])) {
//                 $tour->hotels()->attach($data['hotel_id']);
//             }
// // dd($tour);
//             if (isset($data['guide_id'])) {
//                 $tour->guides()->attach($data['guide_id']);
//             }

//             $activityDates = [];

            // if (isset($data['activity_dates']['time'])) {
            //     foreach ($data['activity_dates']['time'] as $key => $time) {
            //         array_push($activityDates, $time);
            //     }
            // }

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $tour = $this->model->findOrFail($id);
            $tour->activityDates()->delete();
            $tour->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }

    public function findOrFail($id)
    {
        try {
            return $this->model->with(['hotels', 'guides', 'activityDates'])
                ->findOrFail($id);
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
