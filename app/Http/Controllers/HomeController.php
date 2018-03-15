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
}
