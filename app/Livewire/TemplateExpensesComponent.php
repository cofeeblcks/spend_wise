<?php

namespace App\Livewire;

use App\Actions\TemplateExpenses\CreateTemplateExpense;
use App\Actions\TemplateExpenses\DeleteTemplateExpense;
use App\Actions\TemplateExpenses\TemplateExpenseFinder;
use App\Actions\TemplateExpenses\TemplateExpensesList;
use App\Actions\TemplateExpenses\UpdateTemplateExpense;
use App\Traits\ToastNotifications;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class TemplateExpensesComponent extends Component
{
    use ToastNotifications;
    use WithPagination;

    public bool $showModalCreateOrEdit = false;
    public bool $showModalDelete = false;
    public bool $createRegister = true;

    public bool $showModalCreateRecurringPayment = false;
    public bool $showModalDeleteRecurringPayment = false;
    public bool $createRegisterRecurringPayment = true;

    public int $id;
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
        'totalInstallments' => null,
        'categoryId' => null,
        'frequencyId' => null,
    ];

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

    public function validationAttributes()
    {
        return [
            'basicData.name' => 'nombre de la plantilla',
            'basicData.description' => 'descripción de la plantilla',
        ];
    }

    public function messages(): array
    {
        return [
            'basicData.name.required' => 'El :attribute es requerido.',
            'basicData.description.required' => 'La :attribute es requerida.',
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

    private function getTemplateExpenses(): LengthAwarePaginator
    {
        $response = (new TemplateExpensesList())->execute();

        if ($response['success']) {
            return $response['templateExpenses'];
        }

        return new LengthAwarePaginator([], 0, 1);
    }

    private function resetFields(): void
    {
        $this->reset([
            'id',
            'name',
            'basicData',
            'createRegister',
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

    /**
     * Function for register payment recurrings in template expenses
     * @author Hadik Chavez (ChivoDev) -  CofeeBlcks <cofeeblcks@gmail.com, chavezhadik@gmail.com>
     * @param integer $id
     * @return void
     */
    public function createRecurringPayment(int $id):void
    {
        $this->id = $id;
        $this->showModalCreateRecurringPayment = true;
    }
}
