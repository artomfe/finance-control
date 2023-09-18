<script setup>
    import CardSvg from '@/Components/CardSvg.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Wallet">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ativos da Carteira
            </h2>
        </template>

        <article class="ml-6 mr-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 items-center flex space-x-10">
                <div class="flex items-center justify-around p-6 bg-white xs:w-full md:w-1/5
                        rounded-xl space-x-2 mt-10 shadow-lg">
                    <div>
                        <span class="text-sm font-semibold text-gray-400">Total investido</span>
                        <h1 class="text-2xl font-bold">R$ {{formatNumber(wallet.totalAmount)}}</h1>
                    </div>
                </div>
                <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/5 rounded-xl
                        space-x-2 mt-10 shadow-lg">
                    <div>
                        <span class="text-sm font-semibold text-gray-400">Dividendos</span>
                        <h1 class="text-2xl font-bold">R$ {{formatNumber(wallet.totalEarning)}}</h1>
                    </div>
                </div>
                <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/5 rounded-xl
                        space-x-2 mt-10 shadow-lg">
                    <div>
                        <span class="text-sm font-semibold text-gray-400">Total Atual</span>
                        <h1 class="text-2xl font-bold">R$ {{formatNumber(wallet.currentTotal)}}</h1>
                    </div>
                </div>
                <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/5 rounded-xl
                        space-x-2 mt-10 shadow-lg">
                    <div>
                        <span class="text-sm font-semibold text-gray-400">Variação</span>
                        <h1 class="text-2xl font-bold">{{wallet.profitPercentage}}%</h1>
                    </div>
                </div>
                <div class="flex items-center justify-around p-6 bg-white w-1/2 md:w-1/5 rounded-xl
                        space-x-2 mt-10 shadow-lg">
                    <div>
                        <span class="text-sm font-semibold text-gray-400">Percentual Total</span>
                        <h1 class="text-2xl font-bold">{{wallet.profitTotalPercentage}}%</h1>
                    </div>
                </div>
            </div>
        </article>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Ativos da carteira</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PM</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço Atual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total investido</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Atual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dividendos</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valorização</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="active in assets" :key="active.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.asset.code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.average_price.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.asset.current_quote.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.total_amount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.current_total.toFixed(2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ active.total_earning }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-green-300" :class="{'text-red-300': active.profit_percentage < 0}">
                                    {{ active.profit_percentage }}%
                                </td>
                                <td class="px-6 py-4 bold whitespace-nowrap text-green-500" :class="{'text-red-500': active.profit_percentage_total < 0}">
                                    {{ active.profit_percentage_total }}%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        walletAssets: Array,
        wallet: Object
    },
    computed: {
        assets() {
            const sortedAssets = [...this.walletAssets];
            // Ordene os ativos com base no campo 'current_total'
            sortedAssets.sort((a, b) => b.current_total - a.current_total);
            return sortedAssets;
        }
    },
    methods: {
        formatNumber(value) {
            return value.toFixed(2).replace('.', ',');
        },
    },
}
</script>