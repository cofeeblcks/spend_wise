<?php

namespace App\Actions\Expenses;

use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class UpdateExpense
{
    public function execute(int $expenseId, array $data): array
    {
        try {
            DB::beginTransaction();

            $expense = (new ExpenseFinder())->execute($expenseId);
            $this->fillData($expense, $data);
            $expense->update();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Gasto actualizado exitosamente.',
                'expense' => $expense
            ];
        } catch (\Exception $e) {
            Log::channel('ExpenseError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function fillData(Expense $model, array $data): void
    {
        $getFillables = $model->getFillable();
        foreach ($data as $key => $value) {
            if( in_array(Str::snake($key), $getFillables) ){
                if( Str::snake($key) == 'amount' ){
                    $value = str_replace('.', '', $value);
                }
                $model->{Str::snake($key)} = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
