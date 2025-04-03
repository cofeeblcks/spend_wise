<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Schedule::command('payments:reminders')
        ->dailyAt('00:00')
        ->onSuccess(function () {
            Log::channel('PaymentReminders')->info('Success payment reminders sent');
        })
        ->onFailure(function () {
            Log::channel('PaymentReminders')->error('Failed to send payment reminders.');
        });
