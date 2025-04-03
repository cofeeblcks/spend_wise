<main class="flex h-full w-full flex-1 flex-col">

    <x-overlay target="store, storeRecurringPayment" />

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('dashboard') }}" icon="home" />
        @foreach ($breadcumbs as $breadcumb)
            <flux:breadcrumbs.item href="{{ !empty($breadcumb['route']) ? route($breadcumb['route']) : '' }}">{{ $breadcumb['name'] }}</flux:breadcrumbs.item>
        @endforeach
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

    @if( $templateExpenses->isEmpty() )
        <div class="my-2 grid grid-cols-1 gap-4">
            <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 shadow-xl shadow-dark-xl rounded-2xl bg-clip-border">
                <div class="flex items-center m-4 text-center border rounded-lg h-96 dark:border-gray-700">
                    <div class="flex flex-col w-full max-w-sm p-4 mx-auto">
                        <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <h1 class="mt-3 text-lg text-gray-800 dark:text-white">{{ __('Empty registers') }}</h1>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">{{ __('Please try again or create add a new register.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="my-2 grid grid-cols-4 gap-4">
            @foreach ($templateExpenses as $templateExpense )
                <div class="flex flex-col flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mt-6 md:flex-none">
                        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                            <div class="flex justify-between items-center p-6 px-4 pb-0 mb-0 border-b-0">
                                <div>
                                    <h6 class="mb-0 font-semibold">{{ $templateExpense->name }}</h6>
                                    <div class="flex flex-col text-sm text-gray-500">
                                        <span>{{ $templateExpense->description ?? '' }}</span>
                                    </div>
                                </div>
                                <flux:dropdown>
                                    <flux:button class="border-0" icon-trailing="ellipsis-vertical"></flux:button>

                                    <flux:menu>
                                        <flux:menu.item icon="pencil-square" wire:click="edit({{ $templateExpense->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="dollar-sign" wire:click="createExpense({{ $templateExpense->id }})">Registrar gasto</flux:menu.item>
                                        <flux:menu.item icon="history" wire:click="createRecurringPayment({{ $templateExpense->id }})">Registrar pagos recurrentes</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $templateExpense->id }})">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </div>
                            <div class="flex-auto p-4 pt-6">
                                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                    <li class="grid grid-cols-1 gap-1 p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-emphasis">
                                        <div class="flex flex-row items-center">
                                            <span>Gastos registrados: {{ $templateExpense->expenses->count() }}</span>
                                            @if( $templateExpense->expenses->count() > 0 )
                                                <flux:badge wire:click="showExpenses({{ $templateExpense->id }})" variant="pill" icon="view" as="button" color="green" inset="top bottom" class="ml-2 cursor-pointer">Ver</flux:badge>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span>Total de gastos: {{ config('app.currency.symbol') }} {{ number_format($templateExpense->expenses->sum('amount'), 0, ',', '.') }}</span>
                                        </div>
                                    </li>

                                    <li class="grid grid-cols-1 gap-1 p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-emphasis">
                                        <div class="flex flex-row items-center">
                                            <span>Pagos recurrentes: {{ $templateExpense->recurringPayments->count() }}</span>
                                            @if( $templateExpense->recurringPayments->count() > 0 )
                                                <flux:badge wire:click="showRecurringPayments({{ $templateExpense->id }})" variant="pill" icon="view" as="button" color="green" inset="top bottom" class="ml-2 cursor-pointer">Ver</flux:badge>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span>Total de pagos recurrentes: {{ config('app.currency.symbol') }} {{ number_format($templateExpense->recurringPayments->sum('amount'), 0, ',', '.') }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="flex flex-col mt-2">
        {{ $templateExpenses->links() }}
    </div>

    {{-- Modals --}}
    @if( $showModalCreateOrEdit )
        <flux:modal wire:model.self="showModalCreateOrEdit" :dismissible="false" variant="flyout" class="md:w-1/2">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ $createRegister ? 'Crear' : 'Editar' }} plantilla de gastos</flux:heading>
                </div>

                <flux:input label="Nombre plantilla" placeholder="Ej: Gastos del mes" wire:model="basicData.name" />

                <flux:textarea label="Descripción" placeholder="Gastos generados para el mes" rows="auto" wire:model="basicData.description" />

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    @if( $createRegister )
                        <flux:button wire:click="store" :loading="true" variant="primary">Guardar</flux:button>
                    @else
                        <flux:button wire:click="update" :loading="true" variant="primary">Guardar cambios</flux:button>
                    @endif
                </div>
            </div>
        </flux:modal>
    @endif

    @if( $showModalDelete )
        <flux:modal wire:model.self="showModalDelete" :dismissible="false" class="min-w-[22rem]">
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
    @endif

    {{-- Recurring payments --}}
    @if( $showModalCreateRecurringPayment )
        <flux:modal wire:model.self="showModalCreateRecurringPayment" :dismissible="false" variant="flyout" class="md:w-1/2">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ $createRegisterRecurringPayment ? 'Crear' : 'Editar' }} pago recurrente</flux:heading>
                </div>

                <flux:textarea label="Descripción" placeholder="Pago de arriendo" rows="auto" wire:model="dataRecurringPayment.description" />

                <flux:input type="text" label="Valor" placeholder="Ej: 1.000" wire:model="dataRecurringPayment.amount" x-mask:dynamic="$money($input, ',')" />

                <div class="grid grid-cols-3 gap-4 xs:grid-cols-1">
                    <flux:input type="date" label="Fecha de inicio" wire:model.live.lazy="dataRecurringPayment.startDate"  />

                    <flux:input type="date" label="Fecha de final" wire:model.live.lazy="dataRecurringPayment.endDate"  />

                    <flux:input type="text" label="Día de pago" wire:model="dataRecurringPayment.paymentDay" x-mask:dynamic="'99'"  />
                </div>

                <div class="grid grid-cols-3 gap-4 xs:grid-cols-1">
                    <x-select
                        label="Categoría"
                        wire:model.live="dataRecurringPayment.categoryId"
                        dataset="App\Actions\Settings\Categories\CategoriesList"
                        :params="[
                            'recordsPerPage' => 10,
                            'output' => 'paginate',
                        ]"
                    />

                    <x-select
                        label="Frecuencia de pago"
                        wire:model.live="dataRecurringPayment.frequencyId"
                        dataset="App\Actions\Settings\Frequencies\FrequenciesList"
                        :params="[
                            'recordsPerPage' => 10,
                            'output' => 'paginate',
                        ]"
                    />

                    <flux:input type="number" label="Número de cuotas" placeholder="Ej: 5" wire:model="dataRecurringPayment.totalInstallments" />
                </div>

                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    @if( $createRegisterRecurringPayment )
                        <flux:button wire:click="storeRecurringPayment" :loading="true" variant="primary">Guardar</flux:button>
                    @else
                        <flux:button wire:click="updateRecurringPayment" :loading="true" variant="primary">Guardar cambios</flux:button>
                    @endif
                </div>
            </div>
        </flux:modal>
    @endif

    @if( $showModalShowRecurringPayments )
        <flux:modal wire:model.self="showModalShowRecurringPayments" :dismissible="true" variant="flyout" class="md:w-3/4">
            <div>
                <flux:heading size="xl">Pagos recurrentes: {{ $name }}</flux:heading>
            </div>
            <div class="space-y-6">
                <div class="my-2 grid grid-cols-1 gap-4 mt-8">
                    <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-1 shadow-xl shadow-dark-xl rounded-2xl bg-clip-border">
                        <x-table :ths="['Item', 'Categoria', 'Descripción', 'Fecha', 'Frecuencia de pago', 'Día de pago', 'Cuotas', 'Valor', 'Total', 'Acciones']">
                            <x-slot name="trs">
                                @foreach ($recurringPayments ?? [] as $recurringPayment)
                                    <tr class="odd:bg-white even:bg-emphasis hover:bg-accent/10">
                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap rounded-l-xl">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            <flux:badge variant="pill" as="button" color="blue" inset="top bottom">{{ $recurringPayment->category->name }}</flux:badge>
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ $recurringPayment->description }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap @if( !empty($recurringPayment->end_date) ) flex flex-col @endif">
                                            <flux:badge variant="pill" icon="calendar-arrow-up" as="button" color="green">{{ $recurringPayment->start_date->format('Y-m-d') }}</flux:badge>
                                            @if( !empty($recurringPayment->end_date) )
                                                <flux:badge variant="pill" icon="calendar-arrow-down" as="button" color="red" class="mt-2">{{ $recurringPayment->end_date->format('Y-m-d') }}</flux:badge>
                                            @endif
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ $recurringPayment->frequency->name }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ $recurringPayment->payment_day }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ $recurringPayment->expenses->count() }} @if( !empty($recurringPayment->total_installments) ) /{{ $recurringPayment->total_installments }} @endif
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ config('app.currency.symbol') }}{{ number_format($recurringPayment->amount, 0, ',', '.') }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ config('app.currency.symbol') }}{{ number_format($recurringPayment->amount * $recurringPayment->total_installments, 0, ',', '.') }}
                                        </td>

                                        <td class="px-4 py-4 text-sm text-center whitespace-nowrap rounded-r-xl">
                                            <flux:dropdown>
                                                <flux:button class="border-0" icon-trailing="ellipsis-vertical"></flux:button>

                                                <flux:menu>
                                                    <flux:menu.item icon="pencil-square" wire:click="editRecurringPayment({{ $recurringPayment->id }})">Editar</flux:menu.item>
                                                    <flux:menu.item icon="trash" variant="danger" wire:click="deleteRecurringPayment({{ $recurringPayment->id }})">Eliminar</flux:menu.item>
                                                </flux:menu>
                                            </flux:dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-table>
                        <div class="flex flex-col my-3">
                            <flux:badge size="lg" class="flex justify-end my-2 text-xl !text-accent font-semibold">Total de pagos recurrentes: {{ config('app.currency.symbol') }}{{ number_format($recurringPayments->sum('amount'), 0, ',', '.') }}</flux:badge>
                        </div>
                    </div>
                </div>
            </div>
        </flux:modal>
    @endif

    @if( $showModalDeleteRecurringPayment )
        <flux:modal wire:model.self="showModalDeleteRecurringPayment" :dismissible="false" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Eliminar pago recurrente?</flux:heading>

                    <flux:subheading>
                        <p>Estas seguro de eliminar el pago recurrente <strong>{{ $name }}</strong>?</p>
                        <p>Esta acción no se puede deshacer.</p>
                    </flux:subheading>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="destroyRecurringPayment" variant="danger">Si, eliminar</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif

    {{-- Create or Edit expenses --}}
    @if( $showModalCreateExpense )
        <flux:modal wire:model.self="showModalCreateExpense" :dismissible="false" variant="flyout" class="md:w-1/2">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ $createRegisterExpense ? 'Registrar' : 'Editar' }} gasto</flux:heading>
                    <flux:text class="mt-2">Si el gasto no es un pago recurrente, puedes dejar el <strong>pago recurrente</strong> en blanco</flux:text>
                </div>

                <x-select
                    label="Pago recurrente"
                    wire:model.live="dataExpense.recurringPaymentId"
                    dataset="App\Actions\RecurringPayments\RecurringPaymentsList"
                    :params="[
                        'recordsPerPage' => 10,
                        'output' => 'paginate',
                        'templateExpenseId' => $templateExpenseId
                    ]"
                    :disabled="$disabledInputExpense"
                />

                <flux:textarea label="Descripción" placeholder="Pago de arriendo" rows="auto" wire:model="dataExpense.description" />

                <flux:input type="text" label="Valor" placeholder="Ej: 1.000" wire:model="dataExpense.amount" x-mask:dynamic="$money($input, ',')" />

                <flux:input type="date" label="Fecha de pago" wire:model.live.lazy="dataExpense.paymentDate" />

                <x-select
                    label="Categoría"
                    wire:model.live="dataExpense.categoryId"
                    dataset="App\Actions\Settings\Categories\CategoriesList"
                    :params="[
                        'recordsPerPage' => 10,
                        'output' => 'paginate',
                    ]"
                    :disabled="$disabledInputExpense"
                />

                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    @if( $createRegisterExpense )
                        <flux:button wire:click="storeExpense" :loading="true" variant="primary">Guardar</flux:button>
                    @else
                        <flux:button wire:click="updateExpense" :loading="true" variant="primary">Guardar cambios</flux:button>
                    @endif
                </div>
            </div>
        </flux:modal>
    @endif

    @if( $showModalShowExpenses )
        <flux:modal wire:model.self="showModalShowExpenses" :dismissible="true" variant="flyout" class="md:w-3/4">
            <div>
                <flux:heading size="xl">Gastos: {{ $name }}</flux:heading>
            </div>
            <div class="space-y-6">
                <div class="my-2 grid grid-cols-1 gap-4 mt-8">
                    <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-1 shadow-xl shadow-dark-xl rounded-2xl bg-clip-border">
                        <x-table :ths="['Item', 'Categoria', 'Descripción', 'Fecha de pago', 'Valor', 'Acciones']">
                            <x-slot name="trs">
                                @foreach ($expenses ?? [] as $expense)
                                    <tr class="odd:bg-white even:bg-emphasis hover:bg-accent/10">
                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap rounded-l-xl">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            <flux:badge variant="pill" as="button" color="blue" inset="top bottom">{{ $expense->category->name }}</flux:badge>
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ $expense->description }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap flex flex-col">
                                            {{ $expense->payment_date->format('Y-m-d') }}
                                        </td>

                                        <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                            {{ config('app.currency.symbol') }}{{ number_format($expense->amount, 0, ',', '.') }}
                                        </td>

                                        <td class="px-4 py-4 text-sm text-center whitespace-nowrap rounded-r-xl">
                                            <flux:dropdown>
                                                <flux:button class="border-0" icon-trailing="ellipsis-vertical"></flux:button>

                                                <flux:menu>
                                                    <flux:menu.item icon="pencil-square" wire:click="editExpense({{ $expense->id }})">Editar</flux:menu.item>
                                                    <flux:menu.item icon="trash" variant="danger" wire:click="deleteExpense({{ $expense->id }})">Eliminar</flux:menu.item>
                                                </flux:menu>
                                            </flux:dropdown>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-slot>
                        </x-table>
                        <div class="flex flex-col my-3">
                            <flux:badge size="lg" class="flex justify-end my-2 text-xl !text-accent font-semibold">Total de gastos: {{ config('app.currency.symbol') }}{{ number_format($expenses->sum('amount'), 0, ',', '.') }}</flux:badge>
                        </div>
                    </div>
                </div>
            </div>
        </flux:modal>
    @endif

    @if( $showModalDeleteExpense )
        <flux:modal wire:model.self="showModalDeleteExpense" :dismissible="false" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Eliminar gasto?</flux:heading>

                    <flux:subheading>
                        <p>Estas seguro de eliminar el gasto <strong>{{ $name }}</strong>?</p>
                        <p>Esta acción no se puede deshacer.</p>
                    </flux:subheading>
                </div>

                <div class="flex gap-2">
                    <flux:spacer />

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button wire:click="destroyExpense" variant="danger">Si, eliminar</flux:button>
                </div>
            </div>
        </flux:modal>
    @endif
</main>
