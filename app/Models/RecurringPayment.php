<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecurringPayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'amount',
        'start_date',
        'end_date',
        'total_installments',
        'status',
        'template_expense_id',
        'category_id',
        'frequency_id',
    ];

    protected $casts = [
        'amount' => 'float',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
    ];

    public function templateExpense(): BelongsTo
    {
        return $this->belongsTo(TemplateExpense::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function frequency(): BelongsTo
    {
        return $this->belongsTo(Frequency::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
