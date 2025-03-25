<?php

namespace App\Livewire;

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

    public bool $showModalShowRecurringPayment = false;

    public int $id;
    public string $name;

    public int $idRecurringPayment;

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

    public $recurringPayments;

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
            'dataRecurringPayment.endDate' => ['required', 'date', 'after_or_equal:dataRecurringPayment.startDate'],
            'dataRecurringPayment.paymentDay' => ['required', 'numeric', 'between:1,31'],
            'dataRecurringPayment.totalInstallments' => ['required', 'numeric'],
            'dataRecurringPayment.categoryId' => ['required', 'numeric', 'exists:categories,id'],
            'dataRecurringPayment.frequencyId' => ['required', 'numeric', 'exists:frequencies,id'],
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
            'id',
            'name',
            'basicData',
            'createRegister',
            'dataRecurringPayment',
            'recurringPayments'
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

    public function edit(int $id):void
    {
        $templateExpense = (new TemplateExpenseFinder())->execute($id);

        $this->basicData = [
            'name' => $templateExpense->name,
            'description' => $templateExpense->description
        ];

        $this->id = $id;
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

        $response = (new UpdateTemplateExpense())->execute($this->id, $this->basicData);

        if ($response['success']) {
            $this->showSuccess('Actualización de plantilla', $response['message'], 5000);
        }else{
            $this->showError('Actualización de plantilla', $response['message'], 5000);
            exit;
        }
        $this->resetFields();
        $this->showModalCreateOrEdit = false;
    }

    public function delete(int $id):void
    {
        $templateExpense = (new TemplateExpenseFinder())->execute($id);

        $this->id = $id;
        $this->name = $templateExpense->name;
        $this->showModalDelete = true;
    }

    public function destroy(): void
    {
        $response = (new DeleteTemplateExpense())->execute($this->id);

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
    }

    public function showRecurringPayments(int $id): void
    {
        $templateExpense = (new TemplateExpenseFinder())->execute($id);

        $this->recurringPayments = $templateExpense->recurringPayments;
        $this->id = $id;
        $this->name = $templateExpense->name;
        $this->showModalShowRecurringPayment = true;
    }

    /**
     * Function for register payment recurrings in template expenses
     * @author Hadik Chavez (ChivoDev) -  CofeeBlcks <cofeeblcks@gmail.com, chavezhadik@gmail.com>
     * @param integer $id
     * @return void
     */
    public function createRecurringPayment(int $id):void
    {
        $this->resetFields();
        $this->id = $id;
        $this->showModalCreateRecurringPayment = true;
    }

    public function storeRecurringPayment():void
    {
        try {
            $this->validateRecurringPayment();
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->dataRecurringPayment['templateExpenseId'] = $this->id;

        $response = (new CreateRecurringPayment())->execute($this->dataRecurringPayment);

        if ($response['success']) {
            $this->showSuccess('Registro de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Registro de pago recurrente', $response['message'], 5000);
            exit;
        }

        $this->showModalCreateRecurringPayment = false;
    }

    public function editRecurringPayment(int $id):void
    {
        $recurringPayment = (new RecurringPaymentFinder())->execute($id);

        $this->dataRecurringPayment = [
            'description' => $recurringPayment->description,
            'amount' => number_format($recurringPayment->amount, 0, ',', '.'),
            'startDate' => $recurringPayment->start_date->format('Y-m-d'),
            'endDate' => $recurringPayment->end_date->format('Y-m-d'),
            'paymentDay' => $recurringPayment->payment_day,
            'totalInstallments' => $recurringPayment->total_installments,
            'categoryId' => $recurringPayment->category_id,
            'frequencyId' => $recurringPayment->frequency_id,
        ];

        $this->idRecurringPayment = $id;
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

        $response = (new UpdateRecurringPayment())->execute($this->idRecurringPayment, $this->dataRecurringPayment);

        if ($response['success']) {
            $this->showSuccess('Actualización de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Actualización de pago recurrente', $response['message'], 5000);
            exit;
        }

        $this->showRecurringPayments($this->id);
        $this->showModalCreateRecurringPayment = false;
    }

    public function deleteRecurringPayment(int $id):void
    {
        $recurringPayment = (new RecurringPaymentFinder())->execute($id);

        $this->idRecurringPayment = $id;
        $this->name = $recurringPayment->description;
        $this->showModalDeleteRecurringPayment = true;
    }

    public function destroyRecurringPayment(): void
    {
        $response = (new DeleteRecurringPayment())->execute($this->idRecurringPayment);

        if ($response['success']) {
            $this->showSuccess('Eliminación de pago recurrente', $response['message'], 5000);
        }else{
            $this->showError('Eliminación de pago recurrente', $response['message'], 5000);
            exit;
        }
        $this->showRecurringPayments($this->id);
        $this->showModalDeleteRecurringPayment = false;
    }
}
