<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TourInterface;
use App\Repositories\Contracts\CategoryInterface;
use App\Http\Requests\TourImportRequest;
use App\Http\Requests\TourRequest;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Carbon\Carbon;
use App\Models\Tour;

class TourController extends Controller
{
    protected $tourRepository;
    protected $categoryRepository;

    public function __construct(
        TourInterface $tourRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->tourRepository = $tourRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = $this->tourRepository->getAll();

        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tours.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        $data = $request->only([
            'name',
            'category_id',
            'hotel_id',
            'guide_id',
            'price',
            'time_start',
            'time_finish',
            'place',
            'participants_min',
            'participants_max',
            'description',
            'thumbnail',
            // 'activity_dates',
            // 'time',
            // 'title',
            // 'detail',
        ]);

        $response = $this->tourRepository->store($data);
        if ($response) {
            Session::flash('message', trans('admin/tour.messages.create_success'));

            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', trans('admin/tour.messages.create_fail'));

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->tourRepository->delete($id);

        if ($response) {
            return redirect()->route('admin.tour.index')->with('message', 'Delete tour success!');
        }

        return redirect()->route('admin.tour.index')->with('error', 'Delete tour faild');
    }

    public function importTour(TourImportRequest $request)
    {
        // dd($request->all());
        $categoriesId = $this->categoryRepository->getCategoriesId()->toArray();
        Excel::load($request->file_import, function($reader) use ($categoriesId) {
            // dd( $categoriesId, $request->file_import);

            $error = '';
            $success = config('setting.import_success_default_val');
            foreach ($reader->toArray() as $index => $record) {
                try {
                    if (!in_array($record['category_id'], $categoriesId) || $record['time_finish']->lte($record['time_start'])) {
                        throw new Exception();
                    }
                    // dd($record);
                    $this->tourRepository->create($record);
                    $success ++;
                } catch (Exception $e) {
                    $error .= $index + 1 . ', ';
                    continue;
                }
            }

            $error = trim($error, ', ');
            Session::flash('success_msg', trans('lang.success_import_1') . $success . trans('lang.success_import_2'));
            Session::flash('error_msg', trans('lang.error_import_1') . $error . trans('lang.error_import_2'));
        });

        return redirect()->route('admin.tour.index');
    }
}
