<?php

namespace App\Actions\Settings\Categories;

use Illuminate\Support\Facades\Log;

final class DeleteCategory
{
    public function execute(int $categoryId): array
    {
        try {
            $category = (new CategoryFinder())->execute($categoryId);

            $category->delete();

            return [
                'success' => true,
                'message' => 'Categroría eliminada con exito.'
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
