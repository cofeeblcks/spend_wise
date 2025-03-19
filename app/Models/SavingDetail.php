<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavingDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'amount',
        'is_income',
        'saving_id',
    ];

    protected $casts = [
        'is_income' => 'boolean',
    ];
}
