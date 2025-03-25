<?php

namespace App\Actions\Settings\Frequencies;

use Illuminate\Support\Facades\Log;

final class DeleteFrequency
{
    public function execute(int $frequencyId): array
    {
        try {
            $frequency = (new FrequencyFinder())->execute($frequencyId);

            $frequency->delete();

            return [
                'success' => true,
                'message' => 'Frecuencia eliminada con exito.'
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
