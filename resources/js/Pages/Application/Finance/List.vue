<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Selic">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Finances
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button
                    @click="updateFinances()"
                    class="ml-4 bg-violet-500 hover:bg-violet-700 text-white py-2 px-4 rounded"
                >
                    Atualizar valores
                </button>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Finances</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Financeiro</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor investido</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor atual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Porcentagem</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="finance in finances" :key="finance.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.finance.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.investment_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.invested_amount.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ finance.total_amount.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-300" :class="{'text-red-300': finance.percentage < 0}">
                                    {{ finance.percentage }}%
                                </td>
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

            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useToast } from 'vue-toastification';
import NProgress from 'nprogress';

export default {
    props: {
        finances: Object,
        values: Object,
    },
    methods: {
        formatNumber(value) {
            return value.toFixed(2).replace('.', ',');
        },
        async updateFinances() {
            NProgress.start();
            const toast = useToast();

            try {
                const response = await axios.post(route('finances.update'));

                if (response.data.message) {
                    toast.success(response.data.message);
                }

                this.$inertia.reload();
            } catch (error) {
                console.error('Erro ao atualizar:', error);
                toast.error('Erro ao atualizar Finances');
            } finally {
                NProgress.done();
            }
        },
    },
}
</script>