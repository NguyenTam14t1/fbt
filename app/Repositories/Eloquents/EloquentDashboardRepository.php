<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\DashboardInterface;
use App\Models\Tour;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Category;
use DB;

class EloquentDashboardRepository extends EloquentRepository implements DashboardInterface
{
    public function getModel()
    {
        return Tour::class;
    }

    public function getGeneralInfo()
    {
        $numTour = DB::table('tours')->count('*');
        $numGuide = DB::table('users')->join('groups', 'users.group_id', '=', 'groups.id')
                                        ->where('groups.name', 'guide')
                                        ->count('*');
        $numUser = DB::table('users')->join('groups', 'users.group_id', '=', 'groups.id')
                                        ->where('groups.name', 'user')
                                        ->count('*');
        $numHotel = Hotel::count();
        $numCategory = Category::count();

        return compact('numTour', 'numUser', 'numGuide', 'numCategory', 'numHotel');
    }
}
