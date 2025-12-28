<script setup>
import { router, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

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
        { preserveScroll: true }
    )
}
</script>

<template>
    <AppLayout>
        <div class="p-6">

            <!-- HEADER DA PÁGINA -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Fornecedores</h1>
                    <p class="page-subtitle">
                        Gerencie os fornecedores cadastrados no sistema
                    </p>
                </div>

                <button
                    @click="router.visit('/fornecedores/create')"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                    + Novo fornecedor
                </button>
            </div>

            <!-- CARD -->
            <div class="card">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="border p-3">Nome</th>
                            <th class="border p-3">Email</th>
                            <th class="border p-3">Status</th>
                            <th class="border p-3 w-40">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="fornecedor in fornecedores"
                            :key="fornecedor.id"
                            class="hover:bg-gray-50"
                        >
                            <td class="border p-3">
                                {{ fornecedor.nome }}
                            </td>

                            <td class="border p-3">
                                {{ fornecedor.email || '-' }}
                            </td>

                            <td class="border p-3">
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

                            <td class="border p-3 space-x-3">
                                <!-- STATUS -->
                                <button
                                    @click="alterarStatus(fornecedor)"
                                    class="px-3 py-1 text-sm rounded text-white"
                                    :class="fornecedor.status
                                        ? 'bg-red-600 hover:bg-red-700'
                                        : 'bg-green-600 hover:bg-green-700'"
                                >
                                    {{ fornecedor.status ? 'Inativar' : 'Ativar' }}
                                </button>

                                <!-- EDITAR -->
                                <Link
                                    :href="route('fornecedores.edit', fornecedor.id)"
                                    class="text-blue-600 underline text-sm"
                                >
                                    Editar
                                </Link>
                            </td>
                        </tr>

                        <tr v-if="fornecedores.length === 0">
                            <td
                                colspan="4"
                                class="text-center p-6 text-gray-500"
                            >
                                Nenhum fornecedor cadastrado.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </AppLayout>
</template>
