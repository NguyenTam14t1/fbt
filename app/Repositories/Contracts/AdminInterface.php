<?php

namespace App\Repositories\Contracts;

use App\Models\Hotel;

interface HotelInterface
{
    public function getAll();

    public function getHotelsId();

    public function store($data);

    public function delete($id);
}
