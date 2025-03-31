<?php

namespace App\Livewire;

use App\Actions\TemplateExpenses\TemplateExpensesList;
use Carbon\Carbon;
use Livewire\Component;

class CalendarComponent extends Component
{
    public int $currentMonth;
    public int $currentYear;

    public function mount()
    {
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
    }

    public function render()
    {
        return view('livewire.calendar-component', [
            'events' => $this->getEvents(),
        ]);
    }

    public function getEvents(): array
    {
        $response = (new TemplateExpensesList())->execute();

        if( $response['success'] === false ) {
            return [];
        }else{
            $templateExpenses = $response['templateExpenses'];

            $recurringExpenses = $templateExpenses->map(function ($templateExpense) {
                return $templateExpense->recurringPayments->map(function ($recurringPayment) {
                    return [
                        'id' => $recurringPayment->id,
                        'title' => $recurringPayment->description . ' - ' . config('app.currency.symbol') . ' ' . number_format($recurringPayment->amount, 0, ',', '.'),
                        'start' => Carbon::parse($this->currentYear . '-' . $this->currentMonth . '-' . $recurringPayment->payment_day)->format('Y-m-d'),
                        'end' => Carbon::parse($this->currentYear . '-' . $this->currentMonth . '-' . $recurringPayment->payment_day)->format('Y-m-d'),
                        'color' => '#8e44ad',
                    ];
                });
            })->filter()->flatten(1);

            $expenses = $templateExpenses->map(function ($templateExpense) {
                return $templateExpense->expenses->map(function ($expense) {
                    return [
                        'id' => $expense->id,
                        'title' => $expense->description . ' - ' . config('app.currency.symbol') . ' ' . number_format($expense->amount, 0, ',', '.'),
                        'start' => Carbon::parse($expense->payment_date)->format('Y-m-d'),
                        'end' => Carbon::parse($expense->payment_date)->format('Y-m-d'),
                        'color' => '#27ae60',
                    ];
                });
            })->filter()->flatten(1);

            return $recurringExpenses->merge($expenses)->toArray();
        }
    }
}
