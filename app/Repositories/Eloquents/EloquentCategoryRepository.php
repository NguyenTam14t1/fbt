<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\CategoryInterface;
use App\Models\Category;
use App\Models\Tour;
use Carbon\Carbon;

class EloquentCategoryRepository extends EloquentRepository implements CategoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getParentCategories()
    {
        return $this->model->where('parent_id', 0);
    }

    public function getSubCategoriesId(Category $parentCategory)
    {
        return $parentCategory->subCategories()->pluck('id');
    }

    public function getCategoriesId()
    {
        return $this->getAll()->pluck('id');
    }

    public function getToursOfCategory($categoryId, $limit = 0)
    {
        $deadline = Carbon::now()->addDays(config('setting.tour.deadline'));

        if (!$categoryId) {
            return Tour::whereRaw('count_register < participants_max')
                ->where('time_start', '>', $deadline)
                ->orderBy('id', 'desc')
                ->paginate($limit);
        }

        $category = $this->getById($categoryId);

        if (!$category->parent_id) {
            $subCategoriesId = $category->subCategories()->pluck('id');

            return Tour::whereIn('category_id', $subCategoriesId)
                ->whereRaw('count_register < participants_max')
                ->where('time_start', '>', $deadline)
                ->orderBy('id', 'desc')
                ->paginate($limit);
        }

        // $tour = Category::with(['tours' => function ($query) use ($limit) {
        //                 $query->whereRaw('count_register < participants_max')->orderBy('id', 'desc')->paginate($limit);
        //             }])
        //             ->where('id', $categoryId)->paginate($limit);

        // return $tour;
        // return $category->tours()->whereRaw('count_register < participants_max')->orderBy('id', 'desc')->paginate($limit);

        return $category->tours()->whereRaw('count_register < participants_max')
                                ->where('time_start', '>', $deadline)
                                ->orderBy('id', 'desc')
                                ->paginate($limit);
    }
}
