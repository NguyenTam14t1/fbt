<?php

namespace App\Repositories\Contracts;

use App\Models\Category;

interface CategoryInterface
{
    public function getParentCategories();

    public function getSubCategoriesId(Category $parentCategory);

    public function getCategoriesId();
}
