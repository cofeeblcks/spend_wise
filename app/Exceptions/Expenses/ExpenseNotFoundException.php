<?php

namespace App\Exceptions\Expenses;

use Exception;

final class ExpenseNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Expense not found.');
    }
}
