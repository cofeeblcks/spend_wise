<?php

namespace App\Livewire;

use App\Models\Expense;
use App\Traits\WithSelect;
use Carbon\Carbon;
use Livewire\Component;

class ExpenseChartsComponent extends Component
{
    use WithSelect;

    public string $startDate;
    public string $endDate;
    public array $categories = [];

    public function hydrate()
    {
        $this->dispatch('refreshCharts');
    }

    public function mount()
    {
        $this->startDate = Carbon::now()->subMonths(12)->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }

    public function getExpensesData()
    {
        $query = Expense::with('category')
            ->whereBetween('payment_date', [$this->startDate, $this->endDate]);

        if (!empty($this->categories)) {
            $query->whereIn('category_id', $this->categories);
        }

        return $query->get();
    }

    public function getChartData()
    {
        $expenses = $this->getExpensesData();

        // Datos para gráfico de líneas (evolución mensual)
        $monthlyData = $expenses->groupBy(function($item) {
            return Carbon::parse($item->payment_date)->format('Y-m');
        })->map(function($monthExpenses) {
            return $monthExpenses->sum('amount');
        });

        // Datos para gráfico de barras (por categoría)
        $byCategory = $expenses->groupBy('category.name')->map->sum('amount');

        // Datos para gráfico de radar (comparación por categoría y mes)
        $months = $expenses->groupBy(function($item) {
            return Carbon::parse($item->payment_date)->format('Y-m');
        })->keys()->sort()->values()->toArray();

        $categories = $expenses->groupBy('category.name')->keys()->toArray();

        // Preparar datos para radar
        $radarDatasets = [];

        foreach ($categories as $category) {
            $categoryData = [];
            foreach ($months as $month) {
                $total = $expenses->where('category.name', $category)
                    ->filter(function($item) use ($month) {
                        return Carbon::parse($item->payment_date)->format('Y-m') === $month;
                    })
                    ->sum('amount');

                $categoryData[] = $total ?: 0;
            }

            $color = $this->generateCategoryColor($category);

            $radarDatasets[] = [
                'label' => $category,
                'data' => $categoryData,
                'backgroundColor' => $this->hex2rgba($color, 0.2),
                'borderColor' => $color,
                'pointBackgroundColor' => $color,
                'pointBorderColor' => '#fff',
                'pointHoverBackgroundColor' => '#fff',
                'pointHoverBorderColor' => $color,
                'borderWidth' => 2
            ];
        }

        // Formatear labels para mostrar mejor
        $radarLabels = array_map(function($month) {
            return Carbon::createFromFormat('Y-m', $month)->format('M Y');
        }, $months);

        return [
            'line' => [
                'labels' => $monthlyData->keys()->toArray(),
                'datasets' => $monthlyData->values()->toArray(),
            ],
            'bar' => [
                'labels' => $byCategory->keys()->toArray(),
                'datasets' => $byCategory->values()->toArray(),
                'colors' => $this->generateColors($byCategory->count()),
            ],
            'radar' => [
                'labels' => $radarLabels,
                'datasets' => $radarDatasets
            ]
        ];
    }

    protected function generateColors($count)
    {
        $colors = [];
        $hueStep = 360 / ($count ?: 1);

        for ($i = 0; $i < $count; $i++) {
            $hue = $i * $hueStep;
            $colors[] = "hsl($hue, 70%, 50%)";
        }

        return $colors;
    }

    protected function generateCategoryColor($categoryName)
    {
        $hash = md5($categoryName);
        return sprintf('#%s', substr($hash, 0, 6));
    }

    protected function hex2rgba($color, $opacity = 1)
    {
        $rgb = [
            hexdec(substr($color, 1, 2)),
            hexdec(substr($color, 3, 2)),
            hexdec(substr($color, 5, 2))
        ];
        return 'rgba(' . implode(',', $rgb) . ',' . $opacity . ')';
    }

    public function render()
    {
        $chartData = $this->getChartData();

        return view('livewire.expense-charts-component', [
            'lineData' => $chartData['line'],
            'barData' => $chartData['bar'],
            'radarData' => $chartData['radar'],
        ]);
    }
}
