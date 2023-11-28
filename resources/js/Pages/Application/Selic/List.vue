<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Selic">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Selic
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link href="/assets/create"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cadastrar Selic
                </Link>

                <button
                    class="ml-4 bg-violet-500 hover:bg-violet-700 text-white py-2 px-4 rounded"
                >
                    Cadastrar Movimentação
                </button>

                <Link href="/selics/yields"
                    class="ml-4 bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded"
                >
                    Cadastrar Rendimento
                </Link>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Selics</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Investido</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rendimento</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="selic in selics" :key="selic.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ selic.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ selic.amount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ selic.yield }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-300">{{ selic.percentage_yield }}%</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ (selic.amount + selic.yield).toFixed(2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <article class="ml-6 mr-6" v-if="investedAmount">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 items-center flex space-x-10">
                        <div class="flex items-center justify-around p-6 bg-white xs:w-full md:w-1/4
                                rounded-xl space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Total investido</span>
                                <h1 class="text-2xl font-bold">R$ {{ formatNumber(investedAmount) }}</h1>
                            </div>
                        </div>
                        <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/4 rounded-xl
                                space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Rendimento total</span>
                                <h1 class="text-2xl font-bold">R$ {{ formatNumber(yieldAmount) }}</h1>
                            </div>
                        </div>
                        <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/4 rounded-xl
                                space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Total Atual</span>
                                <h1 class="text-2xl font-bold">R$ {{ totalInvested() }} </h1>
                            </div>
                        </div>
                        <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/4 rounded-xl
                                space-x-2 mt-10 shadow-lg">
                            <div>
                                <span class="text-sm font-semibold text-gray-400">Percentual Rendimento</span>
                                <h1 class="text-2xl font-bold text-green-300" :class="{'text-red-300': totalYield() < 0}" >
                                    {{ totalYield() }}%
                                </h1>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        selics: Object,
        investedAmount: Object,
        yieldAmount: Object
    },
    methods: {
        formatNumber(value) {
            return value.toFixed(2).replace('.', ',');
        },
        totalInvested() {
            let total = this.investedAmount + this.yieldAmount;
            return this.formatNumber(total);
        },
        totalYield() {
            let total = (this.yieldAmount / this.investedAmount) * 100;
            return this.formatNumber(total);
        }
    },
}
</script>