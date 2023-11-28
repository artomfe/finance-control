<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
        <h1 class="text-2xl font-semibold text-center mb-4">Cadastrar Selic Rendimento</h1>

        <form @submit.prevent="submit" class="w-full mt-6 mb-6">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="ativo">
                        Selic
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                                    text-gray-700 py-3 px-4 pr-8 rounded leading-tight
                                    focus:outline-none focus:bg-white focus:border-gray-500"
                                id="ativo" v-model="form.selic_id">
                            <option v-for="item in selics" :value="item.id" :key="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6  mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="valor_cota">
                        Valor
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                            focus:bg-white focus:border-gray-500"
                            id="valor_cota" type="text" placeholder="Valor da cota"
                            v-model="form.amount">
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6  mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="data">
                        Data de movimentação
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                            focus:bg-white focus:border-gray-500"
                            id="data" type="text" placeholder="DD/MM/AAAA"
                            v-model="form.movement_date">
                </div>
            </div>
            <div class="flex items-center justify-end mt-2">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Salvar
                </PrimaryButton>
            </div>
        </form> 
    </div>
</template>

<script>
import { useToast } from 'vue-toastification';
import NProgress from 'nprogress';

export default {
    props: {
        selics: Array
    },
    data() {
        return {
            form: this.$inertia.form({
                selic_id: null,
                amount: 0,
                movement_date: null
            }),
            message: null,
        }
    },
    methods: {
        submit() {
            NProgress.start();
            const toast = useToast();

            axios.post(this.route('selics.yields.store'), this.form)
                .then(response => {
                    this.cleanForm()

                    if (response.data.message) {
                        toast.success(response.data.message);
                    }

                    // Atualizar a lista de rendimentos após a atualização
                    this.$inertia.reload();
                })
                .catch(error => {
                    console.error("There was an error!", error);
                    toast.error('Erro ao atualizar ativos');
                })

                NProgress.done();
        },
        cleanForm() {
            let date = this.form.movement_date

            this.form = this.$inertia.form({
                selic_id: null,
                amount: 0,
                movement_date: date
            })
        }
    }
}
</script>