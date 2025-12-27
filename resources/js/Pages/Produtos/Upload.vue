<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
    fornecedores: Array,
})

const form = useForm({
    fornecedor_id: '',
    arquivo: null,
})

function submit() {
    form.post(route('produtos.upload'), {
        forceFormData: true,
    })
}
</script>

<template>
    <div class="p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">Upload de Produtos (CSV)</h1>

        <form @submit.prevent="submit" class="space-y-4">
            <select v-model="form.fornecedor_id" class="w-full border p-2">
                <option value="">Fornecedor</option>
                <option
                    v-for="f in fornecedores"
                    :key="f.id"
                    :value="f.id"
                >
                    {{ f.nome }}
                </option>
            </select>

            <input
                type="file"
                accept=".csv"
                @change="e => form.arquivo = e.target.files[0]"
            />

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Enviar CSV
            </button>
        </form>
    </div>
</template>
