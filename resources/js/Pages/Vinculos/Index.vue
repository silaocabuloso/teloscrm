<script setup>
import { useForm } from '@inertiajs/vue3'

// Props vindas do backend
defineProps({
    vendedores: Array,
    fornecedores: Array,
})

// Formulário de vínculo
const form = useForm({
    user_id: '',
    fornecedor_id: '',
})

// Envia o vínculo
function submit() {
    form.post(route('vinculos.store'))
}
</script>

<template>
    <div class="p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">
            Vínculo Vendedor × Fornecedor
        </h1>

        <form @submit.prevent="submit" class="space-y-4">
            <!-- Select de vendedores -->
            <select v-model="form.user_id" class="w-full border p-2">
                <option value="">Selecione o vendedor</option>
                <option
                    v-for="v in vendedores"
                    :key="v.id"
                    :value="v.id"
                >
                    {{ v.name }}
                </option>
            </select>

            <!-- Select de fornecedores -->
            <select v-model="form.fornecedor_id" class="w-full border p-2">
                <option value="">Selecione o fornecedor</option>
                <option
                    v-for="f in fornecedores"
                    :key="f.id"
                    :value="f.id"
                >
                    {{ f.nome }}
                </option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Vincular
            </button>
        </form>
    </div>
</template>
