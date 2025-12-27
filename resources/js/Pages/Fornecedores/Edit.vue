<script setup>
import { useForm, Link, usePage } from '@inertiajs/vue3'

const page = usePage()

const fornecedor = page.props.fornecedor

const form = useForm({
    nome: fornecedor?.nome ?? '',
    email: fornecedor?.email ?? '',
    cnpj: fornecedor?.cnpj ?? '',
    cep: fornecedor?.cep ?? '',
    endereco: fornecedor?.endereco ?? '',
    status: fornecedor?.status ?? false,
})

function submit() {
    form.put(route('fornecedores.update', fornecedor.id))
}
</script>

<template>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Editar Fornecedor</h1>

        <form @submit.prevent="submit" class="space-y-4">
            <input v-model="form.nome" class="w-full border p-2" />
            <input v-model="form.email" class="w-full border p-2" />
            <input v-model="form.cnpj" class="w-full border p-2" />
            <input v-model="form.cep" class="w-full border p-2" />
            <input v-model="form.endereco" class="w-full border p-2" />

            <label class="flex items-center gap-2">
                <input type="checkbox" v-model="form.status" />
                Ativo
            </label>

            <div class="flex justify-between">
                <Link :href="route('fornecedores.index')">Voltar</Link>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</template>
