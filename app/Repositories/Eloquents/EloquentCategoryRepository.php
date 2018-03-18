<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Eloquents\EloquentRepository;
use App\Repositories\Contracts\CategoryInterface;
use App\Models\Category;

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
}
