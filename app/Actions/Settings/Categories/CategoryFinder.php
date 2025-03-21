<?php

namespace App\Actions\Settings\Categories;

use App\Exceptions\Categories\CategoryNotFoundException;
use App\Models\Category;

final class CategoryFinder
{
    /**
     * @throws CategoryNotFoundException
     */
    public function execute(int $categoryId)
    {
        $category = Category::find($categoryId);

        if (is_null($category)) {
            throw new CategoryNotFoundException();
        }

        return $category;
    }
}
