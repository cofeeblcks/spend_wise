<div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-4 flex items-center justify-center bg-white dark:bg-neutral-800"
    x-data="{
        chartTitle: '{{ $title }}',
        chartId: '{{ $chartId }}',
        data: {{ json_encode($data) }},
        chartType: 'line',
        chart: null,
        isLoading: false,
        async initChart() {
            try {
                this.error = null;
                this.isLoading = true;

                await this.destroyChart();

                const ctxBars = document.getElementById(this.chartId).getContext('2d');
                this.chart = new Chart(ctxBars, {
                    type: this.chartType,
                    data: {
                        labels: this.data.labels,
                        datasets: [{
                            label: this.chartTitle,
                            data: this.data.datasets,
                            fill: true,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            tension: 0.3,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
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
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' $ ' + context.parsed.y.toLocaleString();
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: this.chartTitle,
                                color: '#203A75',
                                font: { size: 16 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$ ' + value.toLocaleString();
                                    }
                                }
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
            console.log('Chart line initialized');
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
