<?php

namespace App\Actions\RecurringPayments;

use Illuminate\Support\Facades\Log;

final class DeleteRecurringPayment
{
    public function execute(int $recurringPaymentId): array
    {
        try {
            $recurringPayment = (new RecurringPaymentFinder())->execute($recurringPaymentId);

            $recurringPayment->delete();

            return [
                'success' => true,
                'message' => 'Pago recurrente eliminado con exito.'
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
