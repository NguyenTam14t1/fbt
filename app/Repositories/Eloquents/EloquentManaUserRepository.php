<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\ManaUserInterface;
use App\Models\User;
use DB;
use Auth;

class EloquentManaUserRepository extends EloquentRepository implements ManaUserInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getAll()
    {
        $adminId = Auth::user()->id;

        return $this->model->where('id', '<>', $adminId)->orderBy('id', 'desc')->get();
    }

    public function getUsersId()
    {
        return $this->getAll()->pluck('id');
    }

    public function store($data)
    {
        try {
            $data['password'] = config('setting.password_test');

            User::create($data);

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
            $user = $this->model->findOrFail($id);

            $user->update($input);

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->model->findOrFail($id);
            $user->delete();

            return true;
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }
}
