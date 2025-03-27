<?php

namespace App\Actions\Expenses;

use App\Models\Expense;
use App\Traits\WithActionList;
use Illuminate\Support\Facades\Log;

final class ExpensesList
{
    use WithActionList;

    public ?int $templateExpenseId = null;

    public function execute(?string $filter = null): array
    {
        try {
            $expenses = Expense::query()
                ->when($this->templateExpenseId, function ($query) {
                    return $query->where('template_expense_id', $this->templateExpenseId);
                })
                ->filter($filter);

            return [
                'success' => true,
                'expenses' => $this->run($expenses)
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
