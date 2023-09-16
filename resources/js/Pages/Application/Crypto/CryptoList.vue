<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import Paggination from '@/Components/Paggination.vue';
</script>

<template>
    <AppLayout title="Crypto">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cryptos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link href="/cryptos/create"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cadastrar Crypto
                </Link>

                <button
                    @click="updateCryptos()"
                    class="ml-4 bg-violet-500 hover:bg-violet-700 text-white py-2 px-4 rounded"
                >
                    Atualizar Cryptos
                </button>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Cryptos</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cotação Atual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="crypto in cryptos.data" :key="crypto.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ crypto.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ crypto.code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ crypto.current_quote }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <Link href="/assets/detail"
                                            class="px-3 py-1 bg-green-500 hover:bg-green-700 text-white rounded">
                                            Detalhes
                                        </Link>
                                        <button
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-700 text-white rounded"
                                        >
                                            Editar
                                        </button>
                                        <button
                                            @click="removeCrypto(crypto.id)"
                                            class="px-3 py-1 bg-red-500 hover:bg-red-700 text-white rounded"
                                        >
                                            Remover
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <Paggination :prev="cryptos.prev_page_url" :next="cryptos.next_page_url" :links="cryptos.links"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useToast } from 'vue-toastification';
import NProgress from 'nprogress';

export default {
  props: {
    cryptos: Object
  },
  methods: {
    async removeCrypto(cryptoId) {
        const confirmed = confirm('Tem certeza que deseja remover esta crypto?');
        if (!confirmed) return;

        const toast = useToast();

        try {
            await this.$inertia.delete(route('cryptos.destroy', cryptoId));
            // Atualizar a lista de cryptos após a remoção
            this.$inertia.reload();

            toast.success('Crypto removida com sucesso')

        } catch (error) {
            console.error('Erro ao remover a crypto:', error);
            toast.success('Erro ao remover a crypto')
        }
    },
    async updateCryptos() {
        NProgress.start();
        const toast = useToast();

        try {
            const response = await axios.post(route('cryptos.updatePrices'));

            if (response.data.message) {
                toast.success(response.data.message);
            }

            // Atualizar a lista de cryptos após a atualização
            this.$inertia.reload();
        } catch (error) {
            console.error('Erro ao atualizar:', error);
            toast.error('Erro ao atualizar cryptos');
        } finally {
            NProgress.done();
        }
    },
  },
}
</script>

