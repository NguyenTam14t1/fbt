<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\GuideInterface;
use App\Models\Guide;
use DB;

class EloquentGuideRepository extends EloquentRepository implements GuideInterface
{
    public function getModel()
    {
        return Guide::class;
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function getGuidesId()
    {
        return $this->getAll()->pluck('id');
    }

    // public function store($acticeDates, $tourId)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $data = [];

    //         foreach ($acticeDates as $key => $value) {
    //             $data['tour_id'] = $tourId;
    //             $data = $value;
    //             dd($data);
    //             $this->model->create($data);
    //         }

    //         DB::commit();

    //         return true;
    //     } catch (Exception $e) {
    //         report($e);
    //         DB::rollBack();

    //         return false;
    //     }
    // }
}
