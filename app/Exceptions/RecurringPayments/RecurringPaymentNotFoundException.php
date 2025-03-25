<?php

namespace App\Exceptions\RecurringPayments;

use Exception;

final class RecurringPaymentNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Recurring payment not found.');
    }
}
