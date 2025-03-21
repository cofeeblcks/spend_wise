<?php

namespace App\Actions\TemplateExpenses;

use App\Models\TemplateExpense;
use Illuminate\Support\Facades\Log;

final class TemplateExpensesList
{
    public function execute(?string $filter = null): array
    {
        try {
            $templateExpenses = TemplateExpense::query()
                ->filter($filter);

            return [
                'success' => true,
                'templateExpenses' => $templateExpenses->get()
            ];
        } catch (\Exception $e) {
            Log::channel('TemplateExpenseError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
