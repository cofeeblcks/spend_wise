<?php

namespace App\Exceptions\Categories;

use Exception;

final class CategoryNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Category not found.');
    }
}
