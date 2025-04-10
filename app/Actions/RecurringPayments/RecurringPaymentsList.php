<?php

namespace App\Actions\RecurringPayments;

use App\Models\RecurringPayment;
use App\Traits\WithActionList;
use Illuminate\Support\Facades\Log;

final class RecurringPaymentsList
{
    use WithActionList;

    public ?int $templateExpenseId = null;

    public function execute(?string $filter = null): array
    {
        try {
            $recurringPayments = RecurringPayment::query()
                ->when($this->templateExpenseId, function ($query) {
                    return $query->where('template_expense_id', $this->templateExpenseId);
                })
                ->filter($filter);

            return [
                'success' => true,
                'recurringPayments' => $this->run($recurringPayments)
            ];
        } catch (\Exception $e) {
            Log::channel('RecurringPaymentError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
