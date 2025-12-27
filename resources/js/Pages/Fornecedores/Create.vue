<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    nome: '',
    email: '',
    cnpj: '',
    cep: '',
    endereco: '',
})

function submit() {
    form.post(route('fornecedores.store'))
}
</script>

<template>
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">
            Novo Fornecedor
        </h1>

        <form @submit.prevent="submit" class="space-y-4">

            <div>
                <label class="block font-medium">Nome</label>
                <input
                    v-model="form.nome"
                    type="text"
                    class="w-full border p-2 rounded"
                />
                <span v-if="form.errors.nome" class="text-red-600 text-sm">
                    {{ form.errors.nome }}
                </span>
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full border p-2 rounded"
                />
            </div>

            <div>
                <label class="block font-medium">CNPJ</label>
                <input
                    v-model="form.cnpj"
                    type="text"
                    maxlength="14"
                    class="w-full border p-2 rounded"
                />
                <span v-if="form.errors.cnpj" class="text-red-600 text-sm">
                    {{ form.errors.cnpj }}
                </span>
            </div>

            <div>
                <label class="block font-medium">CEP</label>
                <input
                    v-model="form.cep"
                    type="text"
                    maxlength="8"
                    class="w-full border p-2 rounded"
                />
            </div>

            <div>
                <label class="block font-medium">Endereço</label>
                <input
                    v-model="form.endereco"
                    type="text"
                    class="w-full border p-2 rounded"
                />
            </div>

            <div class="flex gap-3">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded"
                    :disabled="form.processing"
                >
                    Salvar
                </button>

                <Link
                    :href="route('fornecedores.index')"
                    class="px-4 py-2 border rounded"
                >
                    Cancelar
                </Link>
            </div>
        </form>
    </div>
</template>
