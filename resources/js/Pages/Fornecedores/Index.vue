<script setup>
import { router, Link } from '@inertiajs/vue3'

defineProps({
    fornecedores: {
        type: Array,
        default: () => [],
    },
})

function alterarStatus(fornecedor) {
    router.patch(
        route('fornecedores.status', fornecedor.id),
        {},
        {
            preserveScroll: true,
        }
    )
}
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Fornecedores</h1>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="fornecedor in fornecedores"
                    :key="fornecedor.id"
                >
                    <td class="border p-2">
                        {{ fornecedor.nome }}
                    </td>

                    <td class="border p-2">
                        {{ fornecedor.email }}
                    </td>

                    <td class="border p-2">
                        <span
                            v-if="fornecedor.status"
                            class="text-green-600 font-semibold"
                        >
                            Ativo
                        </span>
                        <span
                            v-else
                            class="text-red-600 font-semibold"
                        >
                            Inativo
                        </span>
                    </td>

                    <td class="border p-2 space-x-3">
                        <!-- BOTÃO STATUS -->
                        <button
                            @click="alterarStatus(fornecedor)"
                            class="px-3 py-1 text-sm rounded text-white"
                            :class="fornecedor.status
                                ? 'bg-red-600'
                                : 'bg-green-600'"
                        >
                            {{ fornecedor.status ? 'Inativar' : 'Ativar' }}
                        </button>

                        <!-- LINK EDITAR -->
               <Link
    :href="route('fornecedores.edit', fornecedor.id)"
    class="text-blue-600 underline"
>
    Editar
</Link>
                    </td>
                </tr>

                <tr v-if="fornecedores.length === 0">
                    <td
                        colspan="4"
                        class="text-center p-4 text-gray-500"
                    >
                        Nenhum fornecedor cadastrado.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
