<?php

namespace App\Exceptions\Frequencies;

use Exception;

final class FrequencyNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Frequency not found.');
    }
}
