<?php

namespace App\Actions\RecurringPayments;

use App\Models\RecurringPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class CreateRecurringPayment
{
    public function execute(array $data): array
    {
        try {
            DB::beginTransaction();
            $recurringPayment = new RecurringPayment();

            $this->fillData($recurringPayment, $data);
            $recurringPayment->save();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Pago recurrente creado exitosamente.',
                'recurringPayment' => $recurringPayment
            ];
        } catch (\Exception $e) {
            Log::channel('RecurringPaymentError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => 'Error al crear la plantilla.'
            ];
        }
    }

    private function fillData(RecurringPayment $model, array $data): void
    {
        $getFillables = $model->getFillable();
        foreach ($data as $key => $value) {
            if( in_array(Str::snake($key), $getFillables) ){
                if( Str::snake($key) == 'amount' ){
                    $value = str_replace('.', '', $value);
                }
                $model->{Str::snake($key)} = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
