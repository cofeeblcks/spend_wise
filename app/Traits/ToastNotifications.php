<?php

namespace App\Traits;

trait ToastNotifications
{

    public function showSuccess(string $title, string $message, int $duration = 3000): void
    {
        $this->dispatch('add-notification', [
            "type" => 'success',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }

    public function showError(string $title, string $message, int $duration = 3000): void
    {
        $this->dispatch('add-notification', [
            "type" => 'danger',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }

    public function showWarning(string $title, string $message, int $duration = 3000): void
    {
        $this->dispatch('add-notification', [
            "type" => 'warning',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }

    public function showInfo(string $title, string $message, int $duration = 3000): void
    {
        $this->dispatch('add-notification', [
            "type" => 'info',
            "title" => $title,
            "message" => $message,
            "duration" => $duration
        ]);
    }
}
