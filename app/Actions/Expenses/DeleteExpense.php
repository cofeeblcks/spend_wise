<?php

namespace App\Actions\Expenses;

use Illuminate\Support\Facades\Log;

final class DeleteExpense
{
    public function execute(int $expenseId): array
    {
        try {
            $expense = (new ExpenseFinder())->execute($expenseId);

            $expense->delete();

            return [
                'success' => true,
                'message' => 'Gasto eliminado con exito.'
            ];
        } catch (\Exception $e) {
            Log::channel('ExpenseError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
