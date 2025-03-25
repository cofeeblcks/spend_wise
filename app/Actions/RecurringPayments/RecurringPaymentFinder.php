<?php

namespace App\Actions\RecurringPayments;

use App\Exceptions\RecurringPayments\RecurringPaymentNotFoundException;
use App\Models\RecurringPayment;

final class RecurringPaymentFinder
{
    /**
     * @throws RecurringPaymentNotFoundException
     */
    public function execute(int $recurringPaymentId)
    {
        $recurringPayment = RecurringPayment::find($recurringPaymentId);

        if (is_null($recurringPayment)) {
            throw new RecurringPaymentNotFoundException();
        }

        return $recurringPayment;
    }
}
