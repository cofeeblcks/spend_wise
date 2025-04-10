<?php

namespace App\Actions\TemplateExpenses;

use App\Models\TemplateExpense;
use App\Traits\WithActionList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

final class TemplateExpensesList
{
    use WithActionList;

    public function execute(?string $filter = null): array
    {
        try {
            $templateExpenses = TemplateExpense::query()
                ->filter($filter)
                ->when(Auth::user(), function($query){
                    return $query->where('user_id', Auth::user()->id);
                });

            return [
                'success' => true,
                'templateExpenses' => $this->run($templateExpenses)
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
