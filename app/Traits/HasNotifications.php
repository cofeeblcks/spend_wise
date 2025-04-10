<?php

namespace App\Traits;

use App\Enums\NotificationsEnum;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasNotifications
{
    public function notification(): MorphMany
    {
        return $this->morphMany(Notification::class, 'model');
    }

    public function sendNotification(string $title, array $data, NotificationsEnum $type)
    {
        return $this->notification()->create([
            'title'=> $title,
            'data' => $data,
            'notification_type_id' => $type
        ]);
    }
}
