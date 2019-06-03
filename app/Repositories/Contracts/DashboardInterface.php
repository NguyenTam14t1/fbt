<?php

namespace App\Repositories\Contracts;


interface DashboardInterface
{
    public function getGeneralInfo();

    public function getDataCountViewLesson($input);
}
