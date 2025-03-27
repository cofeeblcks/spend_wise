<main class="flex h-full w-full flex-1 flex-col">

    <x-overlay target="store" />

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
                        <h5 class="mb-1 font-semibold">Categorias</h5>
                        <p class="mb-0 font-regular leading-normal dark:opacity-60 text-sm">Listado de categorias</p>
                    </div>
                </div>
                <div class="flex px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:flex-none">
                    <div class="relative right-0">
                        <flux:button wire:click="create" :loading="true" variant="primary" icon="plus">
                            Crear categoria
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-2 grid grid-cols-1 gap-4">
        <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words bg-white border-0 shadow-xl shadow-dark-xl rounded-2xl bg-clip-border">
            <x-table :ths="['Nombre', 'Descripción', 'Acciones']">
                <x-slot name="trs">
                    @foreach ($categories as $category)
                        <tr class="odd:bg-white even:bg-emphasis hover:bg-accent/10">
                            <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap rounded-l-xl">
                                {{ $category->name }}
                            </td>

                            <td class="px-12 py-4 text-sm text-center font-medium whitespace-nowrap">
                                {{ $category->description ?? '-' }}
                            </td>

                            <td class="px-4 py-4 text-sm text-center whitespace-nowrap rounded-r-xl">
                                <flux:dropdown>
                                    <flux:button class="border-0" icon-trailing="ellipsis-vertical"></flux:button>

                                    <flux:menu>
                                        <flux:menu.item icon="pencil-square" wire:click="edit({{ $category->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $category->id }})">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>

            {{ $categories->links() }}
        </div>
    </div>

    {{-- Modals --}}
    <flux:modal wire:model.self="showModalCreateOrEdit" :dismissible="false" variant="flyout">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $createRegister ? 'Crear' : 'Editar' }} categoria de gastos</flux:heading>
            </div>

            <flux:input label="Nombre categoria" placeholder="Ej: Hogar" wire:model="basicData.name" />

            <flux:textarea label="Descripción" placeholder="Arriendo" rows="auto" wire:model="basicData.description" />

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

    <flux:modal wire:model.self="showModalDelete" :dismissible="false" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Eliminar categoria?</flux:heading>

                <flux:subheading>
                    <p>Estas seguro de eliminar la categoria de gastos <strong>{{ $name }}</strong>?</p>
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
