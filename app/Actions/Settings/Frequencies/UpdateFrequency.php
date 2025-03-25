<?php

namespace App\Actions\Settings\Frequencies;

use App\Models\Frequency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class UpdateFrequency
{
    public function execute(int $frequencyId, array $data): array
    {
        try {
            DB::beginTransaction();

            $frequency = (new FrequencyFinder())->execute($frequencyId);
            $this->fillData($frequency, $data);
            $frequency->update();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Frecuencia actualizada exitosamente.',
                'frequency' => $frequency
            ];
        } catch (\Exception $e) {
            Log::channel('FrequencyError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function fillData(Frequency $model, array $data): void
    {
        $getFillables = $model->getFillable();
        foreach ($data as $key => $value) {
            if( in_array(Str::snake($key), $getFillables) ){
                $model->{Str::snake($key)} = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
