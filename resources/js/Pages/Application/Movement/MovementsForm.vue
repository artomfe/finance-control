<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 mt-4">
        <h1 class="text-2xl font-semibold text-center mb-4">Cadastrar movimentação</h1>

        <form @submit.prevent="submit" class="w-full mt-6 mb-6">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="ativo">
                        Ativo
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                                    text-gray-700 py-3 px-4 pr-8 rounded leading-tight
                                    focus:outline-none focus:bg-white focus:border-gray-500"
                                id="ativo" v-model="form.active_id">
                            <option v-for="item in actives" :value="item.id" :key="item.id">
                                {{ item.code }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="carteira">
                        Carteira
                    </label>
                    <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200
                                    text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none
                                    focus:bg-white focus:border-gray-500"
                                id="carteira" v-model="form.wallet_id">
                            <option v-for="item in wallets" :value="item.id" :key="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6  mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="data">
                        Data
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                            focus:bg-white focus:border-gray-500"
                            id="data" type="text" placeholder="DD/MM/AAAA"
                            v-model="form.movement_date">
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6  mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="quantidade">
                        Quantidade
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                            focus:bg-white focus:border-gray-500"
                            id="quantidade" type="text" placeholder="Quantidade"
                            v-model="form.quantity">
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6  mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="valor_cota">
                        Valor cota
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                            focus:bg-white focus:border-gray-500"
                            id="valor_cota" type="text" placeholder="Valor da cota"
                            v-model="form.quota_value">
                </div>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-6  mb-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="valor_total">
                        Valor total
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border
                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                            focus:bg-white focus:border-gray-500"
                            id="valor_total" type="text" disabled
                            :value="sumTotal">
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
        actives: Array,
        wallets: Array,
        activeType: String
    },
    data() {
        return {
            form: this.$inertia.form({
                type: this.activeType,
                active_id: null,
                wallet_id: null,
                quantity: 0,
                quota_value: 0,
                total_amount: 0,
                movement_date: null,
            }),
            message: null,
        }
    },
    methods: {
        submit() {
            NProgress.start();
            const toast = useToast();

            axios.post(this.route('movements.store'), this.form)
                .then(response => {
                    this.cleanForm()

                    if (response.data.message) {
                        toast.success(response.data.message);
                    }

                    // Atualizar a lista de ativos após a atualização
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
                active_id: null,
                wallet_id: null,
                quantity: 0,
                quota_value: 0,
                total_amount: 0,
                movement_date: date,
            })
        }
    },
    computed: {
        sumTotal() {
            return this.form.total_amount = this.form.quantity * this.form.quota_value
        }
    }
}
</script>