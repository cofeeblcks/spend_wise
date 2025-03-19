<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'amount',
        'payment_date',
        'category_id',
        'template_expense_id',
        'recurring_payment_id',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'float',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function templateExpense(): BelongsTo
    {
        return $this->belongsTo(TemplateExpense::class);
    }

    public function recurringPayment(): BelongsTo
    {
        return $this->belongsTo(RecurringPayment::class);
    }
}
