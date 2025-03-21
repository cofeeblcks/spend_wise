<?php

namespace App\Exceptions\TemplateExpenses;

use Exception;

final class TemplateExpenseNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Template expense not found.');
    }
}
