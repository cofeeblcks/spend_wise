<?php

namespace App\Actions\TemplateExpenses;

use App\Models\TemplateExpense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class CreateTemplateExpense
{
    public function execute(array $data): array
    {
        try {
            DB::beginTransaction();
            $templateExpense = new TemplateExpense();

            $user = Auth::user();
            $data['userId'] = $user->id;

            $this->fillData($templateExpense, $data);
            $templateExpense->save();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Plantilla creada exitosamente.',
                'templateExpense' => $templateExpense
            ];
        } catch (\Exception $e) {
            Log::channel('TemplateExpenseError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al crear la plantilla.'
            ];
        }
    }

    private function fillData(TemplateExpense $model, array $data): void
    {
        $getFillables = $model->getFillable();
        foreach ($data as $key => $value) {
            if( in_array(Str::snake($key), $getFillables) ){
                $model->{Str::snake($key)} = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
