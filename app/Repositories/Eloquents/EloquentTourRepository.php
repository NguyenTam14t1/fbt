<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\TourInterface;
use App\Models\ActivityDate;
use App\Models\Tour;
use App\Models\Guest;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Note;
use Exception;
use Date;
use DB;
use App\Repositories\Helpers\ImageHelper;
use App\Repositories\Eloquents\EloquentActivityDateRepository;
use Carbon\Carbon;

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

    public function addNewBookingFromUser($userId, array $data, $tourId)
    {
        try {
            DB::beginTransaction();
            $dataBooking =  array_except($data, ['count_register', 'listGuest']);
            $dataBooking['user_id'] = $userId;

            $booking = Booking::create($dataBooking);
            $dataGuest = $data['listGuest'];

            $this->addGuests($dataGuest, $booking->id);

            if (isset($data['count_register'])) {
                $this->updateCountRegister($data['count_register'], $tourId);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            Report($e);
            DB::rollBack();

            return false;
        }
    }

    public function addGuests($dataGuest, $bookingId)
    {
        try {
            DB::beginTransaction();

            foreach ($dataGuest as $guest) {
                $guest['booking_id'] = $bookingId;

                Guest::create($guest);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }

    public function updateCountRegister($countRegister, $tourId)
    {
        $tour = $this->model->findOrFail($tourId);

        // $dataTour['count_register'] = $tour['count_register'] + $countRegister;
        // $tour->update($dataTour);
        $tour->count_register = $tour['count_register'] + $countRegister;

        $tour->save();

    }

    public function getNewTours($limit = 0)
    {
        $deadline = Carbon::now()->addDays(config('setting.tour.deadline'));

        $tours = $this->model->whereRaw('count_register < participants_max')
                            ->where('time_start', '>', $deadline)
                            ->orderBy('created_at', 'desc')
                            ->limit($limit)
                            ->get();

        return $tours;
    }

    public function getPopularTours($limit = 0)
    {
        $deadline = Carbon::now('Asia/Ho_Chi_Minh')->addDays(config('setting.tour.deadline'));

        $tours = $this->model->withCount('bookings')
                            ->whereRaw('count_register < participants_max')
                            ->where('time_start', '>', $deadline)
                            ->orderBy('bookings_count', 'desc')
                            ->limit($limit)
                            ->get();

        return $tours;
    }

    public function getToursOfCategory(array $categoriesId, $limit = 0)
    {
        $deadline = Carbon::now()->addDays(config('setting.tour.deadline'));

        $tours = $this->model->whereIn('category_id', $categoriesId)
                            ->whereRaw('count_register < participants_max')
                            ->where('time_start', '>', $deadline)
                            ->inRandomOrder()
                            ->limit($limit)
                            ->get();
        return $tours;
    }

    public function searchTour($category, $checkIn, $checkOut, $price, $limit = 0)
    {
        $deadline = Carbon::now()->addDays(config('setting.tour.deadline'));
        $query = $this->model->whereRaw('count_register < participants_max')
                            ->where('time_start', '>', $deadline);

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
                $dataTour['name_thumbnail'] = $data['thumbnail']->getClientOriginalName();
                $dataTour['thumbnail'] = ImageHelper::uploadFile($data['thumbnail'], $type, config('images.paths.' .$type));
            }

            $tour = $this->model->create($dataTour);

            if (isset($data['hotel_id'])) {
                $tour->hotels()->attach($data['hotel_id']);
            }

            if (isset($data['guide_id'])) {
                $tour->guides()->attach($data['guide_id']);
            }

            if (isset($data['activity_dates'])) {
                $this->createActiveDate($data['activity_dates'], $tour->id);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }

    public function createActiveDate($activeDates, $tourId)
    {
        try {
            DB::beginTransaction();
            $data = [];
            $objData = json_decode($activeDates);

            foreach ($objData as $value) {
                $data = [
                    'tour_id' => $tourId,
                    'time' => $value->time,
                    'title' => $value->title,
                    'detail' => $value->detail
                ];

                $itemActive = ActivityDate::create($data);
            }

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

    public function update($input, $id)
    {
        try {
            DB::beginTransaction();

            $tour = $this->model->findOrFail($id);

            $dataTour = array_only($input, [
                'category_id',
                'hotel_id',
                'name',
                'description',
                'place',
                'time_start',
                'time_finish',
                'participants_min',
                'participants_max',
                'price',
            ]);

            $dataTour['category_id'] = $dataTour['category_id'] ?? 0;
            // $dataTour['content_trip_tag'] = strip_tags($dataTour['content']);
            if (is_null($input['name_thumbnail']) && $tour->getOriginal('thumbnail')) {
                $dataTour['thumbnail'] = '';
                $dataTour['name_thumbnail'] = '';

                foreach (config('images.dimensions.thumbnail_tour') as $size => $value) {
                    $fileName = ($size == 'original' ? 'original' : $size ) . '/' . $tour->getOriginal('thumbnail');

                    if ($fileName) {
                        ImageHelper::delete(config('images.paths.thumbnail_tour'), $fileName);
                    }
                }
            }

            if (isset($input['thumbnail'])) {
                $type = 'thumbnail_tour';
                $dataTour['thumbnail'] = ImageHelper::uploadFile($input['thumbnail'], $type, config('images.paths.' . $type));
                $dataTour['name_thumbnail'] = $input['thumbnail']->getClientOriginalName();

                if ($tour->getOriginal('thumbnail')) {
                    foreach (config('images.dimensions.thumbnail_tour') as $size => $value) {
                        $fileName = ($size == 'original' ? 'original' : $size ) . '/' . $tour->getOriginal('thumbnail');

                        if ($fileName) {
                            ImageHelper::delete(config('images.paths.' . $type), $fileName);
                        }
                    }
                }
            }

            $tour->update($dataTour);

            $tour->guides()->detach();

            if (isset($input['guide_id'])) {
                $tour->guides()->attach($input['guide_id']);
            }

            $tour->hotels()->detach();

            if (isset($input['hotel_id'])) {
                $tour->hotels()->attach($input['hotel_id']);
            }

            if (isset($input['activity_dates'])) {
                $this->updateMultiActiveDate($input['activity_dates'], $tour->id);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }

    public function updateMultiActiveDate($activeDates, $tourId)
    {
        try {
            DB::beginTransaction();

            $data = [];
            $objData = json_decode($activeDates);

            foreach ($objData as $key => $value) {

                $tourItem = ActivityDate::find($value->id);

                $data = [
                    'tour_id' => $tourId,
                    'time' => $value->time,
                    'title' => $value->title,
                    'detail' => $value->detail
                ];

                if (isset($tourItem)) {
                    $itemActive = $tourItem->update($data);
                } else {
                    if ($key == 0) {
                        $this->deleteActiveDates($tourId);
                    }

                    $itemActive = ActivityDate::create($data);
                }
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            Report($e);
            DB::rollBack();

            return false;
        }
    }

    public function deleteActiveDates($tourId)
    {
        DB::beginTransaction();

        try {
            $tour = $this->model->findOrFail($tourId);
            $tour->activityDates()->delete();
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
            $tour->bookings()->delete();
            $tour->guides()->detach();
            $tour->hotels()->detach();
            $tour->delete();

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }


    public function getNote() {
        return Note::where('type', '=', 'note')->first();
    }

    public function getTerm() {
        return Note::where('type', '=', 'term')->first();
    }
}
