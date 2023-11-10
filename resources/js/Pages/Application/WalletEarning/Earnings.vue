<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import Paggination from '@/Components/Paggination.vue';
    import EarningForm from './EarningForm.vue';
</script>

<template>
    <AppLayout title="Assets">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rendimentos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link href="/wallets"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Voltar
                </Link>

                <!-- <EarnigForm :actives="actives" :wallets="wallets" :active-type="type"/> -->

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Rendimentos</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ativo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carteira</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor por cota</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Com</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="earning in earnings.data" :key="earning.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ earning.asset.code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ earning.wallet.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ earning.received_quota }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ earning.quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ earning.total_amount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ earning.com_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <Paggination :prev="earnings.prev_page_url" :next="earnings.next_page_url" :links="earnings.links"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        earnings: Object
    },
}
</script>
