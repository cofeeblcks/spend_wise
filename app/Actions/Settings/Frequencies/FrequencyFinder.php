<?php

namespace App\Actions\Settings\Frequencies;

use App\Exceptions\Frequencies\FrequencyNotFoundException;
use App\Models\Frequency;

final class FrequencyFinder
{
    /**
     * @throws FrequencyNotFoundException
     */
    public function execute(int $frequencyId)
    {
        $frequency = Frequency::find($frequencyId);

        if (is_null($frequency)) {
            throw new FrequencyNotFoundException();
        }

        return $frequency;
    }
}
