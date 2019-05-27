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

    public function store($data)
    {
        try {
            Hotel::create($data);

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function findOrFail($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function update($input, $id)
    {
        try {
            $hotel = $this->model->findOrFail($id);

            $hotel->update($input);

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function delete($id)
    {
        try {
            $hotel = $this->model->findOrFail($id);
            $hotel->delete();

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
