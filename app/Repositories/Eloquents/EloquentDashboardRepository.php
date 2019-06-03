<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\DashboardInterface;
use App\Models\Tour;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Category;
use DB;
use Carbon\Carbon;

class EloquentDashboardRepository extends EloquentRepository implements DashboardInterface
{
    const LIMIT_DATE = 30;
    const STUDENT_TYPE = "student";

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

    public function getDataCountViewLesson($input)
    {
        $dataInput['date_start'] = Carbon::now()->subDays(30)->format('Y-m-d');
        $dataInput['date_end'] = Carbon::now()->format('Y-m-d');

        // if ($input['type_range'] == 'day') {
        //     $query = 'select count(*) as num_view,
        //         count(distinct(user_id)) as num_user, date as time from log_access
        //         where date >= "' .$dataInput['date_start']. '" and user_type = "' . self:: STUDENT_TYPE . '"
        //         group by date order by date limit ' . self::LIMIT_DATE;
        // } elseif ($input['type_range'] == 'month') {
        //     $query = 'select count(*) as num_view,
        //                 count(distinct(user_id)) as num_user, DATE_FORMAT(date, "%Y-%m") as time from log_access
        //                 where date >= DATE_SUB("' .$dataInput['date_end']. '", INTERVAL 1 YEAR ) and user_type = "' . self:: STUDENT_TYPE . '"
        //                 GROUP BY YEAR(date), MONTH(date) order by date';
        // } elseif ($input['type_range'] == 'week') {
        //     $dateFirstWeek = $dataInput['date_start'];
        //     $dateOfWeek  = Carbon::parse($dataInput['date_start'])->weekOfYear;
        //     $queryGetWeek = DB::table('log_access')
        //         ->whereBetween('date', [$dataInput['date_start'], $dataInput['date_end']])
        //         ->where('user_type', self:: STUDENT_TYPE)
        //         ->orderBy('date')
        //         ->get()
        //         ->groupBy(function ($el) use (&$dateOfWeek, &$dateFirstWeek) {
        //             $dateOfWeekEl = Carbon::parse($el->date)->weekOfYear;
        //             if ($dateOfWeekEl == $dateOfWeek) {
        //                 return Carbon::parse($dateFirstWeek)->format('Y-m-d');
        //             }
        //             $dateOfWeek = $dateOfWeekEl;
        //             $dateFirstWeek = $el->date;
        //             return Carbon::parse($dateFirstWeek)->format('Y-m-d');
        //         });
        //     $data = array();
        //     foreach ($queryGetWeek as $key => $week) {
        //         $el = array();
        //         $el['num_view'] = count($week);
        //         $el['num_user'] = count($week->unique('user_id'));
        //         $el['time'] = Carbon::parse($key)->endOfWeek()->format('Y-m-d');
        //         array_push($data, $el);
        //     }
        //     return $data;
        // }
        // $data = DB::select($query);
        // return $data;
    }
}
