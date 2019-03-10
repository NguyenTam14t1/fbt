<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TourInterface;
use App\Repositories\Contracts\CategoryInterface;
use App\Http\Requests\TourImportRequest;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Exception;
use Carbon\Carbon;

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
        $tours = $this->tourRepository->paginate(config('setting.paginate_default_val'));

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
    public function store(Request $request)
    {
        //
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
        //
    }

    public function importTour(TourImportRequest $request)
    {
        $categoriesId = $this->categoryRepository->getCategoriesId()->toArray();
        Excel::load($request->file_import, function($reader) use ($categoriesId) {

            $error = '';
            $success = config('setting.import_success_default_val');
            foreach ($reader->toArray() as $index => $record) {
                try {
                    if (!in_array($record['category_id'], $categoriesId) || $record['time_finish']->lte($record['time_start'])) {
                        throw new Exception();
                    }

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
