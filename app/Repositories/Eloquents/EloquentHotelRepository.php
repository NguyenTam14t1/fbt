<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\HotelInterface;
use App\Models\Hotel;
use DB;

class EloquentHotelRepository extends EloquentRepository implements HotelInterface
{
    public function getModel()
    {
        return Hotel::class;
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function getHotelsId()
    {
        return $this->getAll()->pluck('id');
    }

    public function store($acticeDates, $tourId)
    {
        try {
            DB::beginTransaction();
            $data = [];

            foreach ($acticeDates as $key => $value) {
                $data['tour_id'] = $tourId;
                $data = $value;
                dd($data);
                $this->model->create($data);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return false;
        }
    }
}
