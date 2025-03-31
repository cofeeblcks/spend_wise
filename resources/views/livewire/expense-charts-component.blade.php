<div class="space-y-6">
    <!-- Filtros -->
    <div class="grid grid-cols-3 gap-4 xs:grid-cols-1">
        <flux:input type="date" label="Fecha de inicio" wire:model.live.lazy="startDate"  />

        <flux:input type="date" label="Fecha de final" wire:model.live.lazy="endDate"  />

        <x-select
            label="Categoría"
            wire:model.live="categories"
            dataset="App\Actions\Settings\Categories\CategoriesList"
            :multiple="true"
            :params="[
                'recordsPerPage' => 10,
                'output' => 'paginate',
            ]"
        />
    </div>

    <!-- Gráficos -->
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <!-- Gráfico de Líneas - Evolución Mensual -->
        @include('components.charts.line', [
            'title' => 'Gastos Mensuales',
            'chartId' => 'lineChart',
            'data' => $lineData,
        ])

        <!-- Gráfico de Barras - Gastos por Categoría -->
        @include('components.charts.bars', [
            'title' => 'Gastos por Categoría',
            'chartId' => 'barChart',
            'data' => $barData,
        ])

        <!-- Gráfico de Radar - Comparación por Categoría -->
        @include('components.charts.radar', [
            'title' => 'Distribución por Categoría',
            'chartId' => 'radarChart',
            'data' => $radarData,
        ])
    </div>
</div>
