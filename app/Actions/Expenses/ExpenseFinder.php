<?php

namespace App\Actions\Expenses;

use App\Exceptions\Expenses\ExpenseNotFoundException;
use App\Models\Expense;

final class ExpenseFinder
{
    /**
     * @throws ExpenseNotFoundException
     */
    public function execute(int $expenseId)
    {
        $expense = Expense::find($expenseId);

        if (is_null($expense)) {
            throw new ExpenseNotFoundException();
        }

        return $expense;
    }
}
