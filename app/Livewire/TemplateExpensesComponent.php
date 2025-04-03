<?php

namespace App\Livewire;

use App\Actions\Expenses\CreateExpense;
use App\Actions\Expenses\DeleteExpense;
use App\Actions\Expenses\ExpenseFinder;
use App\Actions\Expenses\UpdateExpense;
use App\Actions\RecurringPayments\CreateRecurringPayment;
use App\Actions\RecurringPayments\DeleteRecurringPayment;
use App\Actions\RecurringPayments\RecurringPaymentFinder;
use App\Actions\RecurringPayments\UpdateRecurringPayment;
use App\Actions\Settings\Categories\CategoriesList;
use App\Actions\TemplateExpenses\CreateTemplateExpense;
use App\Actions\TemplateExpenses\DeleteTemplateExpense;
use App\Actions\TemplateExpenses\TemplateExpenseFinder;
use App\Actions\TemplateExpenses\TemplateExpensesList;
use App\Actions\TemplateExpenses\UpdateTemplateExpense;
use App\Constants\FrequencyConstants;
use App\Enums\OutputList;
use App\Traits\ToastNotifications;
use App\Traits\WithSelect;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class TemplateExpensesComponent extends Component
{
    use ToastNotifications;
    use WithPagination, WithSelect;

    public bool $showModalCreateOrEdit = false;
    public bool $showModalDelete = false;
    public bool $createRegister = true;

    public bool $showModalCreateRecurringPayment = false;
    public bool $showModalDeleteRecurringPayment = false;
    public bool $createRegisterRecurringPayment = true;

    public bool $showModalShowRecurringPayments = false;
    public bool $showModalShowExpenses = false;

    public bool $showModalCreateExpense = false;
    public bool $showModalDeleteExpense = false;
    public bool $createRegisterExpense = true;
    public bool $disabledInputExpense = false;

    public int $templateExpenseId;
    public int $recurringPaymentId;
    public int $expenseId;
    public string $name;

    public array $basicData = [
        'name' => null,
        'description' => null,
    ];

    public array $dataRecurringPayment = [
        'description' => null,
        'amount' => null,
        'startDate' => null,
        'endDate' => null,
        'paymentDay' => null,
        'totalInstallments' => null,
        'categoryId' => null,
        'frequencyId' => null,
    ];

    public array $dataExpense = [
        'description' => null,
        'amount' => null,
        'paymentDate' => null,
        'categoryId' => null,
        'recurringPaymentId' => null,
    ];

    public $recurringPayments;
    public $expenses;

    public array $breadcumbs = [
        [
            'name' => 'Gastos',
            'route' => 'expenses'
        ]
    ];

    public function render()
    {
        return view('livewire.template-expenses-component', [
            'templateExpenses' => $this->getTemplateExpenses(),
        ]);
    }

    public function updated($field, $value)
    {
        switch ($field) {
            case 'dataRecurringPayment.startDate':
            case 'dataRecurringPayment.endDate':
            case 'dataRecurringPayment.frequencyId':
                $this->calculateTotalInstallments();
                break;
        }
    }

    public function updatedDataExpenseRecurringPaymentId($value): void
    {
        if( !empty($value) ){
            $recurringPayment = (new RecurringPaymentFinder())->execute($value);

            $this->dataExpense = [
                'description' => $recurringPayment->description,
                'amount' => number_format($recurringPayment->amount, 0, ',', '.'),
                'paymentDate' => null,
                'categoryId' => $recurringPayment->category_id,
                'recurringPaymentId' => $recurringPayment->id,
            ];
        }else{
            $this->reset(['dataExpense']);
        }
    }

    public function validationAttributes()
    {
        return [
            'basicData.name' => 'nombre de la plantilla',
            'basicData.description' => 'descripción de la plantilla',
            'dataRecurringPayment.description' => 'descripción',
            'dataRecurringPayment.amount' => 'valor',
            'dataRecurringPayment.startDate' => 'fecha de inicio',
            'dataRecurringPayment.endDate' => 'fecha de finalización',
            'dataRecurringPayment.paymentDay' => 'fecha de pago',
            'dataRecurringPayment.totalInstallments' => 'total de cuotas',
            'dataRecurringPayment.categoryId' => 'categoría',
            'dataRecurringPayment.frequencyId' => 'frecuencia',
            'dataExpense.description' => 'descripción',
            'dataExpense.amount' => 'valor',
            'dataExpense.paymentDate' => 'fecha de pago',
            'dataExpense.categoryId' => 'categoría',
            'dataExpense.recurringPaymentId' => 'gasto recurrente',
        ];
    }

    public function messages(): array
    {
        return [
            'basicData.name.required' => 'El :attribute es requerido.',
            'basicData.description.required' => 'La :attribute es requerida.',
            'dataRecurringPayment.description.required' => 'La :attribute es requerida.',
            'dataRecurringPayment.amount.required' => 'El :attribute es requerido.',
            'dataRecurringPayment.startDate.required' => 'La :attribute es requerida.',
            'dataRecurringPayment.endDate.required' => 'La :attribute es requerida.',
            'dataRecurringPayment.paymentDay.required' => 'La :attribute es requerida.',
            'dataRecurringPayment.totalInstallments.required' => 'El :attribute es requerido.',
            'dataRecurringPayment.categoryId.required' => 'La :attribute es requerida.',
            'dataRecurringPayment.frequencyId.required' => 'La :attribute es requerida.',
            'dataExpense.description.required' => 'La :attribute es requerida.',
            'dataExpense.amount.required' => 'El :attribute es requerido.',
            'dataExpense.paymentDate.required' => 'La :attribute es requerida.',
            'dataExpense.categoryId.required' => 'La :attribute es requerida.',
            'dataExpense.recurringPaymentId.required' => 'El :attribute es requerido.',
        ];
    }

    private function validateBasicData(): void
    {
        $this->validate([
            'basicData.name' => ['required', 'string', 'max:255'],
            'basicData.description' => ['nullable', 'string', 'max:512'],
        ]);
        $this->resetErrorBag();
    }

    private function validateRecurringPayment(): void
    {
        $this->validate([
            'dataRecurringPayment.description' => ['required', 'string', 'max:255'],
            'dataRecurringPayment.amount' => ['required', 'string'],
            'dataRecurringPayment.startDate' => ['required', 'date'],
            'dataRecurringPayment.endDate' => ['nullable', 'date', 'after_or_equal:dataRecurringPayment.startDate'],
            'dataRecurringPayment.paymentDay' => ['required', 'numeric', 'between:1,31'],
            'dataRecurringPayment.totalInstallments' => ['nullable', 'numeric'],
            'dataRecurringPayment.categoryId' => ['required', 'numeric', 'exists:categories,id'],
            'dataRecurringPayment.frequencyId' => ['required', 'numeric', 'exists:frequencies,id'],
        ]);
        $this->resetErrorBag();
    }

    private function validateExpense(): void
    {
        $this->validate([
            'dataExpense.description' => ['required', 'string', 'max:255'],
            'dataExpense.amount' => ['required', 'string'],
            'dataExpense.paymentDate' => ['required', 'date', 'before_or_equal:today'],
            'dataExpense.categoryId' => ['required', 'numeric', 'exists:categories,id'],
            'dataExpense.recurringPaymentId' => ['nullable', 'numeric', 'exists:recurring_payments,id'],
        ]);
        $this->resetErrorBag();
    }

    private function getTemplateExpenses()
    {
        $response = (new TemplateExpensesList())
            ->setParam('recordPerPage', 10)
            ->setParam('output', OutputList::PAGINATE)
            ->execute();

        if ($response['success']) {
            return $response['templateExpenses'];
        }

        return collect([]);
    }

    public function getCategories(): array
    {
        $response = (new CategoriesList())->execute();

        if ($response['success']) {
            return $response['categories']->pluck('name', 'id')->toArray();
        }

        return [];
    }

    private function resetFields(): void
    {
        $this->reset([
            'templateExpenseId',
            'recurringPaymentId',
            'expenseId',
            'name',
            'basicData',
            'createRegister',
            'dataRecurringPayment',
            'recurringPayments',
            'createRegisterExpense',
            'dataExpense',
            'disabledInputExpense'
        ]);
    }

    public function create(): void
    {
        $this->resetFields();
        $this->showModalCreateOrEdit = true;
    }

    public function store(): void
    {
        try {
            $this->validateBasicData();
        } catch (\Throwable $th) {
            throw $th;
        }

        $response = (new CreateTemplateExpense())->execute($this->basicData);

        if ($response['success']) {
            $this->showSuccess('Registro de plantilla', $response['message'], 5000);
        }else{
            $this->showError('Registro de plantilla', $response['message'], 5000);
            exit;
        }

        $this->showModalCreateOrEdit = false;
    }

    public function edit(int $templateExpenseId):void
    {
        $this->resetFields();

        $templateExpense = (new TemplateExpenseFinder())->execute($templateExpenseId);

        $this->basicData = [
            'name' => $templateExpense->name,
            'description' => $templateExpense->description
        ];

        $this->templateExpenseId = $templateExpenseId;
        $this->createRegister = false;
        $this->showModalCreateOrEdit = true;
    }

    public function update(): void
    {
        try {
            $this->validateBasicData();
        } catch (\Throwable $th) {
            throw $th;
        }

        $response = (new UpdateTemplateExpense())->execute($this->templateExpenseId, $this->basicData);

        if ($response['success']) {
            $this->showSuccess('Actualización de plantilla', $response['message'], 5000);
        }else{
            $this->showError('Actualización de plantilla', $response['message'], 5000);
            exit;
        }
        $this->resetFields();
        $this->showModalCreateOrEdit = false;
    }

    public function delete(int $templateExpenseId):void
    {
        $templateExpense = (new TemplateExpenseFinder())->execute($templateExpenseId);

        $this->templateExpenseId = $templateExpenseId;
        $this->name = $templateExpense->name;
        $this->showModalDelete = true;
    }

    public function destroy(): void
    {
        $response = (new DeleteTemplateExpense())->execute($this->templateExpenseId);

        if ($response['success']) {
            $this->showSuccess('Eliminación de plantilla', $response['message'], 5000);
        }else{
            $this->showError('Eliminación de plantilla', $response['message'], 5000);
            exit;
        }
        $this->resetFields();
        $this->showModalDelete = false;
    }

    private function calculateTotalInstallments(): void
    {
        if( !empty($this->dataRecurringPayment['endDate']) ){
            switch ($this->dataRecurringPayment['frequencyId']) {
                case FrequencyConstants::DAILY:
                    $this->dataRecurringPayment['totalInstallments'] = (int) Carbon::parse($this->dataRecurringPayment['startDate'])->diffInDays($this->dataRecurringPayment['endDate']) + 1;
                    break;

                case FrequencyConstants::WEEKLY:
                    $this->dataRecurringPayment['totalInstallments'] = (int) Carbon::parse($this->dataRecurringPayment['startDate'])->diffInWeeks($this->dataRecurringPayment['endDate']);
                    break;

                case FrequencyConstants::BIWEEKLY:
                    $this->dataRecurringPayment['totalInstallments'] = floor(Carbon::parse($this->dataRecurringPayment['startDate'])->diffInDays($this->dataRecurringPayment['endDate']) / 15);
                    break;

                case FrequencyConstants::MONTHLY:
                    $this->dataRecurringPayment['totalInstallments'] = (int) Carbon::parse($this->dataRecurringPayment['startDate'])->diffInMonths($this->dataRecurringPayment['endDate']) + 1;
                    break;

                default:
                    $this->dataRecurringPayment['totalInstallments'] = null;
                    break;
            }
        }else{
            $this->dataRecurringPayment['totalInstallments'] = null;
        }
    }

    // START Recurring payments
    public function showRecurringPayments(int $templateExpenseId): void
    {
        $templateExpense = (new TemplateExpenseFinder())->execute($templateExpenseId);

        $this->recurringPayments = $templateExpense->recurringPayments;
        $this->templateExpenseId = $templateExpenseId;
        $this->name = $templateExpense->name;
        $this->showModalShowRecurringPayments = true;
    }

    /**
     * Function for register payment recurrings in template expenses
     * @author Hadik Chavez (ChivoDev) -  CofeeBlcks <cofeeblcks@gmail.com, chavezhadik@gmail.com>
     * @param integer $templateExpenseId
     * @return void
     */
    public function createRecurringPayment(int $templateExpenseId):void
    {
        $this->resetFields();
        $this->templateExpenseId = $templateExpenseId;
        $this->showModalCreateRecurringPayment = true;
    }

    public function storeRecurringPayment():void
    {
        try {
            $this->validateRecurringPayment();
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->dataRecurringPayment['templateExpenseId'] = $this->templateExpenseId;

        $response = (new CreateRecurringPayment())->execute($this->dataRecurringPayment);

        if ($response['success']) {
            $this->showSuccess('Registro de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Registro de pago recurrente', $response['message'], 5000);
            exit;
        }

        $this->showModalCreateRecurringPayment = false;
    }

    public function editRecurringPayment(int $templateExpenseId):void
    {
        $recurringPayment = (new RecurringPaymentFinder())->execute($templateExpenseId);

        $this->dataRecurringPayment = [
            'description' => $recurringPayment->description,
            'amount' => number_format($recurringPayment->amount, 0, ',', '.'),
            'startDate' => $recurringPayment->start_date->format('Y-m-d'),
            'endDate' => $recurringPayment->end_date?->format('Y-m-d'),
            'paymentDay' => $recurringPayment->payment_day,
            'totalInstallments' => $recurringPayment->total_installments,
            'categoryId' => $recurringPayment->category_id,
            'frequencyId' => $recurringPayment->frequency_id,
        ];

        $this->recurringPaymentId = $templateExpenseId;
        $this->createRegisterRecurringPayment = false;
        $this->showModalCreateRecurringPayment = true;
    }

    public function updateRecurringPayment():void
    {
        try {
            $this->validateRecurringPayment();
        } catch (\Throwable $th) {
            throw $th;
        }

        $response = (new UpdateRecurringPayment())->execute($this->recurringPaymentId, $this->dataRecurringPayment);

        if ($response['success']) {
            $this->showSuccess('Actualización de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Actualización de pago recurrente', $response['message'], 5000);
            exit;
        }

        $this->showRecurringPayments($this->templateExpenseId);
        $this->showModalCreateRecurringPayment = false;
    }

    public function deleteRecurringPayment(int $templateExpenseId):void
    {
        $recurringPayment = (new RecurringPaymentFinder())->execute($templateExpenseId);

        $this->recurringPaymentId = $templateExpenseId;
        $this->name = $recurringPayment->description;
        $this->showModalDeleteRecurringPayment = true;
    }

    public function destroyRecurringPayment(): void
    {
        $response = (new DeleteRecurringPayment())->execute($this->recurringPaymentId);

        if ($response['success']) {
            $this->showSuccess('Eliminación de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Eliminación de pago recurrente', $response['message'], 5000);
            exit;
        }
        $this->showRecurringPayments($this->templateExpenseId);
        $this->showModalDeleteRecurringPayment = false;
    }
    // END Recurring payments

    //  START Expenses
    public function showExpenses(int $templateExpenseId): void
    {
        $templateExpense = (new TemplateExpenseFinder())->execute($templateExpenseId);

        $this->expenses = $templateExpense->expenses;
        $this->templateExpenseId = $templateExpenseId;
        $this->name = $templateExpense->name;
        $this->showModalShowExpenses = true;
    }

    public function createExpense(int $templateExpenseId):void
    {
        $this->resetFields();
        $this->templateExpenseId = $templateExpenseId;
        $this->showModalCreateExpense = true;
    }

    public function storeExpense():void
    {
        try {
            $this->validateExpense();
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->dataExpense['templateExpenseId'] = $this->templateExpenseId;

        $response = (new CreateExpense())->execute($this->dataExpense);

        if ($response['success']) {
            $this->showSuccess('Registro de gasto', $response['message'], 5000);
        }else{
            $this->showError('Registro de gasto', $response['message'], 5000);
            exit;
        }

        $this->showModalCreateExpense = false;
    }

    public function editExpense(int $expenseId):void
    {
        $expense = (new ExpenseFinder())->execute($expenseId);

        $this->dataExpense = [
            'description' => $expense->description,
            'amount' => number_format($expense->amount, 0, ',', '.'),
            'paymentDate' => $expense->payment_date->format('Y-m-d'),
            'categoryId' => $expense->category_id,
            'recurringPaymentId' => $expense->recurring_payment_id
        ];

        $this->expenseId = $expenseId;
        $this->disabledInputExpense = true;
        $this->createRegisterExpense = false;
        $this->showModalCreateExpense = true;
    }

    public function updateExpense():void
    {
        try {
            $this->validateExpense();
        } catch (\Throwable $th) {
            throw $th;
        }

        $response = (new UpdateExpense())->execute($this->expenseId, $this->dataExpense);

        if ($response['success']) {
            $this->showSuccess('Actualización de gasto', $response['message'], 5000);
        }else{
            $this->showError('Actualización de gasto', $response['message'], 5000);
            exit;
        }

        $this->showExpenses($this->expenseId);
        $this->showModalCreateExpense = false;
    }

    public function deleteExpense(int $expenseId):void
    {
        $expense = (new ExpenseFinder())->execute($expenseId);

        $this->expenseId = $expenseId;
        $this->name = $expense->description;
        $this->showModalDeleteExpense = true;
    }

    public function destroyExpense(): void
    {
        $response = (new DeleteExpense())->execute($this->expenseId);

        if ($response['success']) {
            $this->showSuccess('Eliminación de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Eliminación de pago recurrente', $response['message'], 5000);
            exit;
        }
        $this->showExpenses($this->expenseId);
        $this->showModalDeleteExpense = false;
    }
    // END Expenses
}
