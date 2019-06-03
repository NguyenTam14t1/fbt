<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\TourInterface;
use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\Contracts\NewsInterface;
use App\Models\News;

class HomeController extends Controller
{

    protected $tourRepository;
    protected $categoryRepository;
    protected $newsRepository;

    public function __construct(
        TourInterface $tourRepository,
        CategoryInterface $categoryRepository,
        NewsInterface $newsRepository
    ) {
        $this->tourRepository = $tourRepository;
        $this->categoryRepository = $categoryRepository;
        $this->newsRepository = $newsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['new_tours'] = $this->tourRepository->getNewTours(config('setting.new_tour_show'));
        $data['popular_tour'] = $this->tourRepository->getPopularTours(config('setting.popular_tour_show'));
        $data['news'] = $this->newsRepository->getRandomNews(config('setting.news_random_show'));
        $data['categories'] = $this->categoryRepository->getParentCategories()->get();

        foreach ($data['categories'] as $category) {
            $subCategoriesId = $this->categoryRepository->getSubCategoriesId($category)->toArray();
            $allTour[$category->name] = $this->tourRepository->getToursOfCategory($subCategoriesId, config('setting.category_tour_show'));
        }

        return view('bookingtour.index', compact('data', 'allTour'));
    }

    public function search(Request $request)
    {
        $data = $request->only([
            'category',
            'check_in',
            'check_out',
            'price'
        ]);

        if ($data['check_in']) {
            $data['check_in'] = str_replace('/', '-', $data['check_in']);
            $data['check_in'] = date('Y-m-d', strtotime($data['check_in']));
        }

        if ($data['check_out']) {
            $data['check_out'] = str_replace('/', '-', $data['check_out']);
            $data['check_out'] = date('Y-m-d', strtotime($data['check_out']));
        }

        $data['tours'] = $this->tourRepository->searchTour(
            $data['category'],
            $data['check_in'],
            $data['check_out'],
            $data['price'],
            config('setting.category_show_paginate')
        );

        if (isset($data['category']) && $data['category'] != 0) {
            $data['category_search'] = $this->categoryRepository->getById($data['category']);
        }

        $data['categories'] = $this->categoryRepository->getParentCategories()->get();
        $data['title'] =  trans('lang.search');

        return view('bookingtour.tour-list', compact('data'));
    }

    public function error()
    {
        return view('widgets.bookingtour.404');
    }
}
