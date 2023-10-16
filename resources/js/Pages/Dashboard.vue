<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import DashboardChart from '@/Charts/DashboardChart.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">RESUMO</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TIPO DE INVESTIMENTO</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VALOR INVESTIDO</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VALOR TOTAL</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VARIAÇÃO PERCENTUAL</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PERCENTUAL</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="finance in finances" :key="finance.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.invested.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.total.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-300" :class="{'text-red-300': finance.percentage_change < 0}">
                                    {{ finance.percentage_change.toFixed(2) }}%
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ finance.total_percentage.toFixed(2) }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <article class="ml-6 mr-6" v-if="values.invested">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 items-center flex space-x-10">
                        <div class="flex items-center justify-around p-6 bg-white xs:w-full md:w-1/3
                                rounded-xl space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Total investido</span>
                                <h1 class="text-2xl font-bold">R$ {{ formatNumber(values.invested) }}</h1>
                            </div>
                        </div>
                        <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/3 rounded-xl
                                space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Total Atual</span>
                                <h1 class="text-2xl font-bold">R$ {{ formatNumber(values.total) }}</h1>
                            </div>
                        </div>
                        <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/3 rounded-xl
                                space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Percentual</span>
                                <h1 class="text-2xl font-bold text-green-300" :class="{'text-red-300': values.percent < 0}"> 
                                    {{ values.percent.toFixed(2) }}% 
                                </h1>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="flex items-center center bg-white mt-10 mb-10">
                    <dashboard-chart 
                        :finances="finances" 
                        :total="values.total"
                        class="flex items-center center md:w-2/3"
                        style="margin-left: 12rem;"
                    />
                </article>

            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        finances: Object,
        values: Object,
    },
    methods: {
        formatNumber(value) {
            return value.toFixed(2).replace('.', ',');
        }
    },
}
</script>
