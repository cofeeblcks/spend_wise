<?php

namespace App\Actions\Settings\Frequencies;

use App\Models\Frequency;
use App\Traits\WithActionList;
use Illuminate\Support\Facades\Log;

final class FrequenciesList
{
    use WithActionList;

    public function execute(?string $filter = null): array
    {
        try {
            $frequencies = Frequency::query()
                ->when($filter, function ($query, $filter) {
                    return $query->where('name', 'like', "%{$filter}%");
                });

            return [
                'success' => true,
                'frequencies' => $this->run($frequencies)
            ];
        } catch (\Exception $e) {
            Log::channel('FrequencyError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");

            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
