<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
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

                <Link href="/assets"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Voltar
                </Link>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
                    <h1 class="text-2xl font-semibold text-center mb-4">Ativo</h1>

                    <form @submit.prevent="submit" class="w-full mt-6 mb-6">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mb-6 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="nome">
                                    Nome
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                                        focus:bg-white focus:border-gray-500"
                                        id="nome" type="text" placeholder="Nome do ativo"
                                        v-model="form.name">
                            </div>
                            <div class="w-full md:w-1/2 lg:w-1/2 px-3 mb-6 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="codigo">
                                    Código
                                </label>
                                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                                        border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                                        focus:bg-white focus:border-gray-500"
                                        id="codigo" type="text" placeholder="Código"
                                        v-model="form.code">
                            </div>
                            <div class="w-full md:w-1/2 lg:w-1/2 px-3 mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="tipo">
                                    Tipo
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                                                text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none
                                                focus:bg-white focus:border-gray-500"
                                            id="tipo" v-model="form.type">
                                        <option value="ACAO">AÇÃO</option>
                                        <option value="FII">FII</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-2">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Salvar
                            </PrimaryButton>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                code: null,
                type: null
            }),
            message: null,
        }
    },
    methods: {
        submit() {
            // axios.post(this.route('actives.store'), this.form)
            //     .then(response => {
            //         this.message = response.data.message
            //     })
            //     .catch(error => {
            //         console.error("There was an error!", error);
            //     });
        }
    },
}
</script>