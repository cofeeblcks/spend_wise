<?php

namespace App\Notifications;

use App\Models\RecurringPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReminderNotification extends Notification
{
    use Queueable;

    public $payment;
    public $dueType;

    /**
     * Create a new notification instance.
     */
    public function __construct(RecurringPayment $payment, $dueType)
    {
        $this->payment = $payment;
        $this->dueType = $dueType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Recordatorio de pago: {$this->payment->name} vence {$this->dueType}")
            ->greeting("Hola {$notifiable->name},")
            ->line("Este es un recordatorio sobre tu pago recurrente:")
            ->line("Concepto: {$this->payment->name}")
            ->line("Categoría: {$this->payment->category->name}")
            ->line("Vence: {$this->dueType} (día {$this->payment->payment_day} del mes)")
            ->action('Ver detalles', url('/payments/'.$this->payment->id))
            ->line('¡Gracias por usar nuestro servicio!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
