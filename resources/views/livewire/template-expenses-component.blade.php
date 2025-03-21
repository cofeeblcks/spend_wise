<main class="flex h-full w-full flex-1 flex-col">

    <x-overlay target="store" />

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
        <flux:breadcrumbs.item href="{{ route('expenses') }}">Gastos</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="my-2 w-full grid grid-cols-1 gap-4">
        <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 shadow-xl shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-auto max-w-full px-3 my-auto">
                    <div class="h-full">
                        <h5 class="mb-1 font-semibold">Plantillas de gastos</h5>
                        <p class="mb-0 font-regular leading-normal dark:opacity-60 text-sm">Listado de plantillas</p>
                    </div>
                </div>
                <div class="flex px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:flex-none">
                    <div class="relative right-0">
                        <flux:button wire:click="create" :loading="true" variant="primary" icon="plus">
                            Crear plantilla de gasto
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-2 grid grid-cols-4 gap-4">
        @foreach ($templateExpenses as $templateExpense )
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mt-6 md:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                        <div class="flex justify-between items-center p-6 px-4 pb-0 mb-0 border-b-0">
                            <h6 class="mb-0 font-semibold">{{ $templateExpense->name }}</h6>
                            <flux:dropdown>
                                <flux:button icon-trailing="ellipsis-vertical"></flux:button>

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square" wire:click="edit({{ $templateExpense->id }})">Editar</flux:menu.item>
                                    <flux:menu.item icon="dollar-sign">Registrar gasto</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $templateExpense->id }})">Eliminar</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </div>
                        <div class="flex-auto p-4 pt-6">
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li class="grid grid-cols-1 gap-1 p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50">
                                    <div class="flex flex-col">
                                        <span>{{ $templateExpense->description ?? '' }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span>Gastos registrados: {{ $templateExpense->expenses->count() }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span>Total de gastos: $ {{ number_format($templateExpense->expenses->sum('amount'), 0, '.', ',') }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Modals --}}
    <flux:modal wire:model.self="showModalExpense" :dismissible="false" variant="flyout" class="md:w-1/2">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $createTemplateExpense ? 'Crear' : 'Editar' }} plantilla de gastos</flux:heading>
            </div>

            <flux:input label="Nombre plantilla" placeholder="Ej: Gastos del mes" wire:model="basicData.name" />

            <flux:textarea label="Descripción" placeholder="Gastos generados para el mes" rows="auto" wire:model="basicData.description" />

            <div class="flex">
                <flux:spacer />
                @if( $createTemplateExpense )
                    <flux:button wire:click="store" :loading="true" variant="primary">Guardar</flux:button>
                @else
                    <flux:button wire:click="update" :loading="true" variant="primary">Guardar cambios</flux:button>
                @endif
            </div>
        </div>
    </flux:modal>

    <flux:modal wire:model.self="showModalDeleteExpense" :dismissible="false" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Eliminar plantilla?</flux:heading>

                <flux:subheading>
                    <p>Estas seguro de eliminar la plantilla de gastos <strong>{{ $name }}</strong>?</p>
                    <p>Esta acción no se puede deshacer.</p>
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="destroy" variant="danger">Si, eliminar</flux:button>
            </div>
        </div>
    </flux:modal>
</main>
