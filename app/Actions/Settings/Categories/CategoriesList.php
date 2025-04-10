<?php

namespace App\Actions\Settings\Categories;

use App\Models\Category;
use App\Traits\WithActionList;
use Illuminate\Support\Facades\Log;

final class CategoriesList
{
    use WithActionList;

    public function execute(?string $filter = null): array
    {
        try {
            $categories = Category::query()
                ->filter($filter);

            return [
                'success' => true,
                'categories' => $this->run($categories)
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
