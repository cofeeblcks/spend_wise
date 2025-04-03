<?php

namespace App\Console\Commands;

use App\Actions\TemplateExpenses\TemplateExpensesList;
use App\Mail\PaymentReminderEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $response = (new TemplateExpensesList())->execute();

        if( $response['success'] ) {
            $templateExpenses = $response['templateExpenses'];

            if( $templateExpenses->count() > 0 ) {
                $count = 0;
                foreach ($templateExpenses as $templateExpense) {
                    $recurringPayments = $templateExpense->recurringPayments()->whereIn('payment_day', [$today, $tomorrow])->get();

                    if( $recurringPayments->count() > 0 ) {
                        foreach ($recurringPayments as $recurringPayment) {
                            try {
                                // Determinar si es para hoy o mañana
                                $dueType = $recurringPayment->payment_day == $today ? 'hoy' : 'mañana';

                                $subject = "Recordatorio de pago: {$recurringPayment->name} vence {$dueType}";
                                $greeting = "Hola {$templateExpense->user->full_name},";
                                $dataBody = [
                                    "Este es un recordatorio sobre tu pago recurrente:",
                                    "Concepto: {$recurringPayment->name}",
                                    "Categoría: {$recurringPayment->category->name}",
                                    "Vence: {$dueType} (día {$recurringPayment->payment_day} del mes)",
                                    "break",
                                    "¡Gracias por usar nuestro servicio!",
                                ];

                                Mail::to($templateExpense->user)
                                ->send(
                                    new PaymentReminderEmail($subject, $greeting, $dataBody)
                                );

                                $count++;
                                $this->info("Recordatorio enviado para pago {$recurringPayment->name} (ID: {$recurringPayment->id})");
                            } catch (\Exception $e) {
                                $this->error("Error enviando recordatorio para pago {$recurringPayment->id}: {$e->getMessage()}");
                                Log::channel('PaymentReminders')->error("Payment reminder failed for payment {$recurringPayment->id}: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
                            }
                        }
                    }
                }

                $this->info("Total de recordatorios enviados: {$count}");
                Log::channel('PaymentReminders')->info("Payment reminders sent: {$count} notifications processed");
            }
        }
    }
}
