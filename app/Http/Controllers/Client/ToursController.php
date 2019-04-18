<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TourInterface;
use App\Traits\ProcessOnClient;
use Auth;


class ToursController extends Controller
{
    use ProcessOnClient;

    protected $tourRepository;
    protected $reviewRepository;

    public function __construct(TourInterface $tourRepository)
    {
        $this->tourRepository = $tourRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data['tour'] = $this->tourRepository->getById($id);
        $data = $this->tourRepository->getRate($id, $data);
        $data['reviews'] = $this->tourRepository->getReviews($data['tour']);
        $data['categories'] = $this->getParentCategories($data['tour']);
        $data['note'] = $this->tourRepository->getNote();

        return view('bookingtour.tour-detail', compact(['data']));
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

    public function review(Request $request)
    {
        $dataRq = $request->only([
            'tour_id',
            'place_rate',
            'food_rate',
            'service_rate',
            'total_rate',
            'content'
        ]);

        $this->tourRepository->addNewReviewFromUser(Auth::user()->id, $dataRq);
        $data['tour'] = $this->tourRepository->getById($dataRq['tour_id']);
        $data['reviews'] = $this->tourRepository->getReviews($data['tour']);
        $data = $this->tourRepository->getRate($dataRq['tour_id'], $data);

        return view('bookingtour.ajax.review', compact(['data']));;
    }

    public function reviewShow(Request $request)
    {
        $data['tour'] = $this->tourRepository->getById($request->tour_id);
        $data['reviews'] = $this->tourRepository->getReviews($data['tour']);
        $data = $this->tourRepository->getRate($request->tour_id, $data);

        return view('bookingtour.ajax.review', compact(['data']));
    }
}
