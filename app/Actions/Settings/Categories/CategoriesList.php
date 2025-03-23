<?php

namespace App\Actions\Settings\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

final class CategoriesList
{
    public ?int $recordsPerPage = null;

    public function execute(?string $filter = null): array
    {

        try {
            $categories = Category::query()
                ->filter($filter);

            $className = $categories->getModel()->getTable();
            $categories = $categories->paginate($this->recordsPerPage ?? 10,['*'], $className.'_page');

            return [
                'success' => true,
                'categories' => $categories
            ];
        } catch (\Exception $e) {
            Log::channel('CategoryError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
