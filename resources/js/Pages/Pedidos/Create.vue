<script setup>
import { useForm } from '@inertiajs/vue3'
import axios from 'axios'

defineProps({ fornecedores: Array })

const form = useForm({
    fornecedor_id: '',
    produtos: [],
})

async function carregarProdutos() {
    const res = await axios.get(
        `/fornecedores/${form.fornecedor_id}/produtos`
    )

    form.produtos = res.data.map(p => ({
        id: p.id,
        nome: p.nome,
        quantidade: 1,
    }))
}

function submit() {
    form.post(route('pedidos.store'))
}
</script>

<template>
    <div class="p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">Novo Pedido</h1>

        <select
            v-model="form.fornecedor_id"
            @change="carregarProdutos"
            class="w-full border p-2 mb-4"
        >
            <option value="">Fornecedor</option>
            <option v-for="f in fornecedores" :key="f.id" :value="f.id">
                {{ f.nome }}
            </option>
        </select>

        <div v-for="p in form.produtos" :key="p.id">
            {{ p.nome }}
            <input
                type="number"
                v-model="p.quantidade"
                min="1"
                class="border ml-2 w-20"
            />
        </div>

        <button
            @click="submit"
            class="mt-4 bg-blue-600 text-white px-4 py-2 rounded"
        >
            Salvar Pedido
        </button>
    </div>
</template>
