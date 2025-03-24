<?php

namespace App\Actions\TemplateExpenses;

use App\Models\TemplateExpense;
use Illuminate\Support\Facades\Log;

final class TemplateExpensesList
{

    public ?int $recordsPerPage = null;

    public function execute(?string $filter = null): array
    {
        try {
            $templateExpenses = TemplateExpense::query()
                ->filter($filter);

            $className = $templateExpenses->getModel()->getTable();
            $templateExpenses = $templateExpenses->paginate($this->recordsPerPage ?? 10,['*'], $className.'_page');
            return [
                'success' => true,
                'templateExpenses' => $templateExpenses
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
