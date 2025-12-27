<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
    fornecedores: {
        type: Array,
        default: () => [],
    },
})

const form = useForm({
    fornecedor_id: '',
    referencia: '',
    nome: '',
    cor: '',
    preco: '',
})

function submit() {
    form.post(route('produtos.store'))
}
</script>

<template>
    <div class="p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">Novo Produto</h1>

        <form @submit.prevent="submit" class="space-y-3">
            <select v-model="form.fornecedor_id" class="w-full border p-2">
                <option value="">Selecione um fornecedor</option>
                <option
                    v-for="f in fornecedores"
                    :key="f.id"
                    :value="f.id"
                >
                    {{ f.nome }}
                </option>
            </select>

            <input
                v-model="form.referencia"
                placeholder="Referência"
                class="w-full border p-2"
            />

            <input
                v-model="form.nome"
                placeholder="Nome"
                class="w-full border p-2"
            />

            <input
                v-model="form.cor"
                placeholder="Cor"
                class="w-full border p-2"
            />

            <input
                v-model="form.preco"
                type="number"
                step="0.01"
                placeholder="Preço"
                class="w-full border p-2"
            />

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded"
            >
                Salvar
            </button>
        </form>
    </div>
</template>
