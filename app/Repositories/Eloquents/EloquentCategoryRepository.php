<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\CategoryInterface;
use App\Models\Category;
use App\Models\Tour;

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
        if (!$categoryId) {
            return Tour::paginate($limit);
        }

        $category = $this->getById($categoryId);

        if (!$category->parent_id) {
            $subCategoriesId = $category->subCategories()->pluck('id');

            return Tour::whereIn('category_id', $subCategoriesId)->paginate($limit);
        }

        return $category->tours()->paginate($limit);
    }
}
