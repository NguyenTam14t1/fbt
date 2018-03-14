<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\NewsInterface;
use App\Models\News;

class EloquentNewsRepository extends EloquentRepository implements NewsInterface
{
    public function getModel()
    {
        return News::class;
    }

    public function getRandomNews($limit = 0)
    {
        return $this->model->inRandomOrder()->limit($limit)->get();
    }
}
