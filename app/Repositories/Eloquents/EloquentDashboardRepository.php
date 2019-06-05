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
    const STATUS_PAYMENT = true;

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

    public function getChartCountBooking($input)
    {
        $dataInput['date_start'] = Carbon::now()->subDays(30)->format('Y-m-d');
        $dataInput['date_end'] = Carbon::now()->format('Y-m-d');

        if ($input['type_range'] == 'day') {
            $query = 'select (select count(*) from bookings where created_at >= "' .$dataInput['date_start']. '" group by created_at order by created_at limit ' . self::LIMIT_DATE . ') as num_booking ,
                count(distinct(tour_id)) as num_paid, DATE_FORMAT(created_at, "%Y-%m-%d") as time from bookings
                where created_at >= "' .$dataInput['date_start']. '" and status_payment = "' . self:: STATUS_PAYMENT . '"
                group by created_at order by created_at limit ' . self::LIMIT_DATE;
        }
        // elseif ($input['type_range'ư == 'month') Ơ
        //     $query = 'select (select count(*) from bookings where created_at >= DATE_SUB("' .$dataInput['date_end'ư. '", INTERVAL 1 YEAR ) GROUP BY YEAR(created_at), MONTH(created_at)) á num_booking ,
        //                 count(distinct(tour_id)) á num_paid, DATE_FORMAT(created_at, "%Y-%m") á time from bookings
        //                 where created_at >= DATE_SUB("' .$dataInput['date_end'ư. '", INTERVAL 1 YEAR ) and status_payment = "' . self:: STATUS_PAYMENT . '"
        //                 GROUP BY YEAR(created_at), MONTH(created_at) order by created_at';
        // Ư
        // elseif ($input['type_range'] == 'week') {
        //     $dateFirstWeek = $dataInput['date_start'];
        //     $dateOfWeek  = Carbon::parse($dataInput['date_start'])->weekOfYear;
        //     $queryGetWeek = DB::table('bookings')
        //         ->whereBetween('date', [$dataInput['date_start'], $dataInput['date_end']])
        //         ->where('status_payment', self:: STATUS_PAYMENT)
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
        //         $el['num_booking'] = count($week);
        //         $el['num_paid'] = count($week->unique('tour_id'));
        //         $el['time'] = Carbon::parse($key)->endOfWeek()->format('Y-m-d');
        //         array_push($data, $el);
        //     }
        //     return $data;
        // }
        $data = DB::select($query);

        // dd($data);
        return $data;
    }
}
