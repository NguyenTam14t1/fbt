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

    public function store($data)
    {
        try {
            $data['password'] = config('setting.password_test');

            Guide::create($data);

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
            $guide = $this->model->findOrFail($id);

            $guide->update($input);

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function delete($id)
    {
        try {
            $guide = $this->model->findOrFail($id);
            $guide->delete();

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
