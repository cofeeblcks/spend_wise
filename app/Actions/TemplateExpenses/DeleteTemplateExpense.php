<?php

namespace App\Actions\TemplateExpenses;

use Illuminate\Support\Facades\Log;

final class DeleteTemplateExpense
{
    public function execute(int $templateExpenseId): array
    {
        try {
            $templateExpense = (new TemplateExpenseFinder())->execute($templateExpenseId);

            $templateExpense->delete();

            return [
                'success' => true,
                'message' => 'Plantilla eliminada con exito.'
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
