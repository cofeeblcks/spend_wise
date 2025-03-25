<?php

namespace App\Actions\Settings\Frequencies;

use App\Models\Frequency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class CreateFrequency
{
    public function execute(array $data): array
    {
        try {
            DB::beginTransaction();
            $frequency = new Frequency();

            $this->fillData($frequency, $data);
            $frequency->save();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Frecuencia creada exitosamente.',
                'frequency' => $frequency
            ];
        } catch (\Exception $e) {
            Log::channel('FrequencyError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al crear la categoría.'
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
