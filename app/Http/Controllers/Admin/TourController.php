<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TourInterface;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\Contracts\HotelInterface;
use App\Repositories\Contracts\GuideInterface;
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
        CategoryInterface $categoryRepository,
        HotelInterface $hotelRepository,
        GuideInterface $guideRepository
    ) {
        $this->tourRepository = $tourRepository;
        $this->categoryRepository = $categoryRepository;
        $this->hotelRepository = $hotelRepository;
        $this->guideRepository = $guideRepository;
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
        $guides = $this->guideRepository->all(['id', 'name']);
        $hotels = $this->hotelRepository->all(['id', 'name']);

        return view('admin.tours.add', compact('guides','hotels'));
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
            'activity_dates',
        ]);

        $response = $this->tourRepository->store($data);

        if ($response) {
            Session::flash('message', 'Tour create success');

            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', 'Ttour create fail');

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
        $tour = $this->tourRepository->findOrFail($id);
        $guides = $this->guideRepository->all(['id', 'name']);
        $hotels = $this->hotelRepository->all(['id', 'name']);

        if (!$tour) {
            return redirect()->route('admin.tour.index')->with('error', 'Tour not found!');
        }

        return view('admin.tours.edit', compact('tour', 'guides', 'hotels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, $id)
    {
        $data = $request->all();

        $result = $this->tourRepository->update($data, $id);

        if ($result) {
            Session::flash('message', 'Tour update success!');

            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', 'Tour update faild!');

        return response()->json([
            'status' => false,
        ]);
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
