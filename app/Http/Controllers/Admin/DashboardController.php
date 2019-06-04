<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DashboardInterface;

class DashboardController extends Controller
{
    public function __construct(DashboardInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {
        $generalInfo = $this->dashboardRepository->getGeneralInfo();

        return view('admin.dashboard', array_merge($generalInfo));
    }

    public function getChartCountBooking(Request $request)
    {
        $input = $request->all();
        return $this->tryCatch($request->all(), function($input) {
            return $this->dashboardRepository->getChartCountBooking($input);
        });
    }
}
