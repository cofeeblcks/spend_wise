<?php

namespace App\Actions\TemplateExpenses;

use App\Models\TemplateExpense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class UpdateTemplateExpense
{
    public function execute(int $templateExpenseId, array $data): array
    {
        try {
            DB::beginTransaction();

            $templateExpense = (new TemplateExpenseFinder())->execute($templateExpenseId);
            $this->fillData($templateExpense, $data);
            $templateExpense->update();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Plantilla actualizada exitosamente.',
                'templateExpense' => $templateExpense
            ];
        } catch (\Exception $e) {
            Log::channel('TemplateExpenseError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
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
