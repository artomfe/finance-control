<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Wallet">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Carteiras
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link href="/assets/create"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cadastrar Carteira
                </Link>
                <Link href="/movements/asset"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold ml-4 py-2 px-4 rounded">
                    Comprar Ativo
                </Link>
                <Link href="/movements/crypto"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold ml-4 py-2 px-4 rounded">
                    Comprar Crypto
                </Link>
                <Link href="/movements-sells/asset"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold ml-4 py-2 px-4 rounded">
                    Vender Ativo
                </Link>
                <Link href="/movements-sells/crypto"
                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold ml-4 py-2 px-4 rounded">
                    Vender Crypto
                </Link>
                <Link href="/yields"
                    class="bg-purple-500 hover:bg-purple-700 text-white font-bold ml-4 py-2 px-4 rounded">
                    Rendimentos
                </Link>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Carteiras</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Corretora</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="wallet in wallets" :key="wallet.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ wallet.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ wallet.broker.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <Link 
                                            v-if="wallet.wallet_type == 1"
                                            :href="'/wallets/assets/'+wallet.id"
                                            class="px-3 py-1 bg-green-500 text-white rounded"
                                        >
                                            Mais detalhes
                                        </Link>
                                        <Link 
                                            v-else
                                            :href="'/wallets/cryptos/'+wallet.id"
                                            class="px-3 py-1 bg-green-500 text-white rounded"
                                        >
                                            Mais detalhes
                                        </Link>
                                    </div>
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
    wallets: Object
  }
}
</script>