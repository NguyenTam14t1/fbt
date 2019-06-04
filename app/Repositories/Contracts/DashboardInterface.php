<?php

namespace App\Repositories\Contracts;


interface DashboardInterface
{
    public function getGeneralInfo();

    public function getChartCountBooking($input);
}
