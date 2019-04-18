<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\ActivityDateInterface;
use App\Models\ActivityDate;
use DB;

class EloquentActivityDateRepository extends EloquentRepository implements ActivityDateInterface
{
    public function getModel()
    {
        return ActivityDate::class;
    }

    public function store($acticeDates, $tourId)
    {
        try {
            DB::beginTransaction();
            $data = [];

            foreach ($acticeDates as $key => $value) {
                $data['tour_id'] = $tourId;
                $data = $value;

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
