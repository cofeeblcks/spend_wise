<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'data',
        'model_type',
        'model_id',
        'notification_type_id',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'data' => 'array',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
