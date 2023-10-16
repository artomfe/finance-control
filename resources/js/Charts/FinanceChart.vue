<template>
    <div>
        <canvas id="financeChart" style="width: 400px; height: 400px;"></canvas>
    </div>
</template>
  
<script>
  import Chart from 'chart.js/auto';
  
export default {
    props: {
        finances: {
            type: Array,
            required: true,
        },
    },
    mounted() {
        // Prepare os dados
        const financeNames = this.finances.map(finance => finance.investment.name);
        const financeAmounts = this.finances.map(finance => finance.total_amount);

        // Use Chart.js para renderizar o gráfico
        const ctx = document.getElementById('financeChart').getContext('2d');

        new Chart(ctx, {
            type: 'pie', // Ou 'bar' para um gráfico de barras
            data: {
                labels: financeNames,
                datasets: [
                    {
                        data: financeAmounts,
                        backgroundColor: [
                            "#77CEFF",
                            "#0079AF",
                            "#123E6B",
                            "#97B0C4",
                            "#A5C8ED",
                            "#FFD700",
                            "#FF6347",
                            "#00FF7F",
                            "#FF69B4",
                            "#FFA07A",
                            "#6B8E23",
                            "#8A2BE2",
                            "#FF4500",
                            "#008080",
                            "#800000"
                        ],
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Gráfico de Finanças',
                        font: {
                            size: 24,
                            weight: 'bold',
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                const value = context.parsed || 0;
                                const total = financeAmounts.reduce((acc, val) => acc + val, 0);
                                const percentage = ((value / total) * 100).toFixed(2) + '%';
                                return `${value} (${percentage})`;
                            },
                        },
                    },
                },
            },
        });
    },
  };
</script>

  