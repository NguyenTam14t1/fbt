<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface ManaUserInterface
{
    public function getAll();

    public function getUsersId();

    public function store($data);

    public function delete($id);
}
