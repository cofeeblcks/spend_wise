<?php

namespace App\Actions\Settings\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class CreateCategory
{
    public function execute(array $data): array
    {
        try {
            DB::beginTransaction();
            $category = new Category();

            $user = Auth::user();
            $data['userId'] = $user->id;

            $this->fillData($category, $data);
            $category->save();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Categoría creada exitosamente.',
                'category' => $category
            ];
        } catch (\Exception $e) {
            Log::channel('CategoryError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al crear la categoría.'
            ];
        }
    }

    private function fillData(Category $model, array $data): void
    {
        $getFillables = $model->getFillable();
        foreach ($data as $key => $value) {
            if( in_array(Str::snake($key), $getFillables) ){
                $model->{Str::snake($key)} = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
