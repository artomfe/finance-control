<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import Paggination from '@/Components/Paggination.vue';
    import MovementsForm from './MovementsForm.vue';
</script>

<template>
    <AppLayout title="Assets">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Movimentações
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

               <MovementsForm :actives="actives" :wallets="wallets" :active-type="type"/>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Movimentações</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ativo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carteira</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor por cota</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="movement in movements.data" :key="movement.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ movement.asset.name || movement.crypto.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ movement.wallet.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ movement.quota_value }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ movement.quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ movement.total_amount }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ movement.movement_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <Paggination :prev="movements.prev_page_url" :next="movements.next_page_url" :links="movements.links"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        movements: Object,
        actives: Array,
        wallets: Array,
        type: String
    },
}
</script>
