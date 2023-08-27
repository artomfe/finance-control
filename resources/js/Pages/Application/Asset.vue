<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3'
</script>

<template>
    <AppLayout title="Assets">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ativos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <h1 class="text-2xl font-semibold text-center mb-4">Lista de Ativos</h1>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cotação Atual</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="asset in assets.data" :key="asset.id">
                                <td class="px-6 py-4 whitespace-nowrap">{{ asset.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ asset.code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ asset.type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ asset.current_quote }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                    <button
                                        @click="editAsset(asset.id)"
                                        class="px-3 py-1 bg-yellow-500 text-white rounded"
                                    >
                                        Editar
                                    </button>
                                    <button
                                        @click="removeAsset(asset.id)"
                                        class="px-3 py-1 bg-red-500 text-white rounded"
                                    >
                                        Remover
                                    </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="mt-4 flex justify-center">
                        <Link
                            :href="assets.prev_page_url"
                            class="px-4 py-2 mr-2 bg-blue-500 text-white rounded"
                            :class="{ 'opacity-50 cursor-not-allowed': !assets.prev_page_url }"
                        >
                            Anterior
                        </Link>

                        <div class="flex items-center space-x-2">
                            <template v-for="page in filteredLinks" :key="page.label">
                                <Link
                                    :href="page.url"
                                    class="px-3 py-2 rounded"
                                    :class="{ 'bg-blue-500 text-white': page.active, 'text-gray-500': !page.active }"
                                >
                                    {{ page.label }}
                                </Link>
                            </template>
                        </div>

                        <Link
                            :href="assets.next_page_url"
                            class="px-4 py-2 ml-2 bg-blue-500 text-white rounded"
                            :class="{ 'opacity-50 cursor-not-allowed': !assets.next_page_url }"
                        >
                            Próximo
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { useToast } from 'vue-toastification';

export default {
  props: {
    assets: Object
  },
  computed: {
    filteredLinks() {
      return this.assets.links.filter((page) => page.label !== "&laquo; Previous" && page.label !== "Next &raquo;").slice(0, 4);
    },
  },
  methods: {
    editAsset(assetId) {
      // Lógica para redirecionar para a página de edição do ativo
    },
    async removeAsset(assetId) {
      const confirmed = confirm('Tem certeza que deseja remover este ativo?');
      if (!confirmed) return;

      const toast = useToast();

      try {
        await this.$inertia.delete(route('assets.destroy', assetId));
        // Atualizar a lista de ativos após a remoção
        this.$inertia.reload();

        toast.success('Ativo removido com sucesso')

      } catch (error) {
        console.error('Erro ao remover o ativo:', error);
        toast.success('Erro ao remover o ativo')
      }
    },
  },
}
</script>
