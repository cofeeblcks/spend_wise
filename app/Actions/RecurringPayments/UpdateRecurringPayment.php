<?php

namespace App\Actions\RecurringPayments;

use App\Models\RecurringPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

final class UpdateRecurringPayment
{
    public function execute(int $recurringPaymentId, array $data): array
    {
        try {
            DB::beginTransaction();

            $recurringPayment = (new RecurringPaymentFinder())->execute($recurringPaymentId);
            $this->fillData($recurringPayment, $data);
            $recurringPayment->update();

            DB::commit();
            return [
                'success' => true,
                'message' => 'Pago recurrente actualizado exitosamente.',
                'recurringPayment' => $recurringPayment
            ];
        } catch (\Exception $e) {
            Log::channel('RecurringPaymentError')->error("Message: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            DB::rollBack();
            return [
                'success' => false,
                'message' => $e->getMessage()
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
                if( Str::snake($key) == 'end_date' ){
                    $value = empty($value) ? null : $value;
                }
                $model->{Str::snake($key)} = is_string($value) ? trim($value) : $value;
            }
        }
    }
}
