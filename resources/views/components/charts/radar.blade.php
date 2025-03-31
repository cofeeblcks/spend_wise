<div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 flex items-center justify-center bg-white dark:bg-neutral-800"
    x-data="{
        chartTitle: '{{ $title }}',
        chartId: '{{ $chartId }}',
        data: {{ json_encode($data) }},
        chartType: 'radar',
        chart: null,
        isLoading: false,
        async initChart() {
            try {
                this.error = null;
                this.isLoading = true;

                await this.destroyChart();

                const ctxBars = document.getElementById(this.chartId).getContext('2d');

                // Verificar que tenemos datos válidos
                const radarData = this.data;

                if (!radarData.labels || radarData.labels.length === 0) {
                    console.error('No hay labels para el gráfico de radar');
                    return;
                }

                if (!radarData.datasets || radarData.datasets.length === 0) {
                    console.error('No hay datasets para el gráfico de radar');
                    return;
                }

                this.chart = new Chart(ctxBars, {
                    type: this.chartType,
                    data: {
                        labels: radarData.labels,
                        datasets: radarData.datasets.map(dataset => ({
                            ...dataset,
                            data: dataset.data.map(value => value || 0) // Asegurar valores numéricos
                        }))
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 12
                                    },
                                    color: '#000',
                                    padding: 20
                                }
                            },
                            title: {
                                display: true,
                                text: this.chartTitle,
                                color: '#203A75',
                                font: { size: 16 }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `${context.dataset.label}: $${context.raw.toLocaleString()}`;
                                    }
                                }
                            },
                            filler: {
                                propagate: true
                            },
                        },
                        scales: {
                            r: {
                                angleLines: {
                                    display: true,
                                    color: 'rgba(200, 200, 200, 0.3)'
                                },
                                suggestedMin: 0,
                                ticks: {
                                    display: false,
                                    stepSize: this.calculateStepSize(radarData.datasets)
                                },
                                pointLabels: {
                                    font: {
                                        size: 10,
                                    },
                                    color: '#666'
                                },
                                beginAtZero: true,
                                grid: {
                                    color: function(context) {
                                        return context.tick.value === 0 ?
                                            'rgba(100, 100, 100, 0.8)' :
                                            'rgba(200, 200, 200, 0.1)';
                                    }
                                },
                                pointLabels: {
                                    color: '#666',
                                    callback: function(value) {
                                        return value.length > 10 ?
                                            value.substring(0, 8) + '...' :
                                            value;
                                    }
                                }
                            }
                        },
                        elements: {
                            line: {
                                tension: 0.1,
                                borderWidth: 2
                            }
                        }
                    }
                });
            } catch (e) {
                console.error('Error al crear gráfico:', e);
            } finally {
                this.isLoading = false;
            }
        },
        calculateStepSize(datasets) {
            const maxValue = Math.max(...datasets.flatMap(d => d.data));
            return Math.ceil(maxValue / 5);
        },
        async destroyChart() {
            if (this.chart) {
                try {
                    this.chart.stop();
                    this.chart.destroy();
                } catch (e) {
                    console.warn('Error al destruir gráfico:', e);
                } finally {
                    this.chart = null;
                }
            }
        },
        async updateChart() {
            try {
                await this.destroyChart();
            }catch (e) {
                console.warn('Error al destruir gráfico:', e);
            } finally {
                this.initChart();
            }
        },
        init() {
            console.log('Chart initialized');
            this.initChart();
            Livewire.on('refreshCharts', () => {
                this.updateChart();
            });
        }
    }"
    @refresh-chart.window="updateChart()"
    wire:ignore.self
>
    <canvas x-bind:id="chartId" class="w-full h-full"></canvas>

    <div x-show="isLoading">
        <div class="absolute bg-white inset-0 items-center justify-center text-accent flex flex-col">
            <flux:icon name="chart-column-stacked" class="w-16 h-12" />
            No hay datos para mostrar el gráfico
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-accent mt-2"></div>
        </div>
    </div>
</div>
