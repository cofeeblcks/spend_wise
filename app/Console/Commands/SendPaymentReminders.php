<?php

namespace App\Console\Commands;

use App\Actions\RecurringPayments\RecurringPaymentsList;
use App\Enums\OutputList;
use App\Notifications\PaymentReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to user about recurring payments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->day;
        $tomorrow = Carbon::now()->addDay()->day;

        $response = (new RecurringPaymentsList())->setParam('output', OutputList::BUILDER)->execute();

        if( $response['success'] ) {
            $recurringPayments = $response['recurringPayments']->whereIn('payment_day', [$today, $tomorrow])->get();

            if( $recurringPayments->count() > 0 ) {
                $count = 0;
                foreach ($recurringPayments as $payment) {
                    try {
                        // Determinar si es para hoy o mañana
                        $dueType = $payment->payment_day == $today ? 'hoy' : 'mañana';

                        // Enviar notificación al usuario asociado
                        $payment->user->notify(new PaymentReminderNotification($payment, $dueType));

                        $count++;
                        $this->info("Recordatorio enviado para pago {$payment->name} (ID: {$payment->id})");
                    } catch (\Exception $e) {
                        $this->error("Error enviando recordatorio para pago {$payment->id}: {$e->getMessage()}");
                        Log::channel('PaymentReminders')->error("Payment reminder failed for payment {$payment->id}: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
                    }
                }

                $this->info("Total de recordatorios enviados: {$count}");
                Log::channel('PaymentReminders')->info("Payment reminders sent: {$count} notifications processed");
            }
        }
    }
}
