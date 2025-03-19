<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saving extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'target_amount',
        'start_date',
        'end_date',
        'status',
        'user_id',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'target_amount' => 'float',
        'status' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(SavingDetail::class);
    }
}
