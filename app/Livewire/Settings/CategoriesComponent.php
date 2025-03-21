<?php

namespace App\Livewire\Settings;

use App\Actions\Settings\Categories\CreateCategory;
use App\Actions\Settings\Categories\DeleteCategory;
use App\Actions\Settings\Categories\CategoryFinder;
use App\Actions\Settings\Categories\CategoriesList;
use App\Actions\Settings\Categories\UpdateCategory;
use App\Traits\ToastNotifications;
use Illuminate\Support\Collection;
use Livewire\Component;

class CategoriesComponent extends Component
{
    use ToastNotifications;

    public bool $showModalCreateOrEdit = false;
    public bool $showModalDelete = false;
    public bool $createRegister = true;

    public int $id;
    public string $name;

    public array $basicData = [
        'name' => null,
        'description' => null,
    ];

    public array $breadcumbs = [
        [
            'name' => 'Ajustes',
            'route' => null
        ],
        [
            'name' => 'Categorías',
            'route' => 'settings.categories'
        ]
    ];

    public function render()
    {
        return view('livewire.settings.categories-component', [
            'categories' => $this->getCategories(),
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

    private function getCategories(): Collection
    {
        $response = (new CategoriesList())->execute();

        if ($response['success']) {
            return collect($response['categories']);
        }

        return collect();
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

        $response = (new CreateCategory())->execute($this->basicData);

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
        $category = (new CategoryFinder())->execute($id);

        $this->basicData = [
            'name' => $category->name,
            'description' => $category->description
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

        $response = (new UpdateCategory())->execute($this->id, $this->basicData);

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
        $category = (new CategoryFinder())->execute($id);

        $this->id = $id;
        $this->name = $category->name;
        $this->showModalDelete = true;
    }

    public function destroy(): void
    {
        $response = (new DeleteCategory())->execute($this->id);

        if ($response['success']) {
            $this->showSuccess('Eliminación de plantilla', $response['message'], 5000);
        }else{
            $this->showError('Eliminación de plantilla', $response['message'], 5000);
            exit;
        }
        $this->resetFields();
        $this->showModalDelete = false;
    }
}
