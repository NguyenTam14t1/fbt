<?php

namespace App\Repositories\Contracts;

use App\Models\Guide;

interface GuideInterface
{
    public function getAll();

    public function getGuidesId();

    public function store($data);

    public function delete($id);
}
