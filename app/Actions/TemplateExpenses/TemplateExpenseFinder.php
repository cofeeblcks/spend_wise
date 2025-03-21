<?php

namespace App\Actions\TemplateExpenses;

use App\Exceptions\TemplateExpenses\TemplateExpenseNotFoundException;
use App\Models\TemplateExpense;

final class TemplateExpenseFinder
{
    /**
     * @throws TemplateExpenseNotFoundException
     */
    public function execute(int $templateExpenseId)
    {
        $templateExpense = TemplateExpense::find($templateExpenseId);

        if (is_null($templateExpense)) {
            throw new TemplateExpenseNotFoundException();
        }

        return $templateExpense;
    }
}
