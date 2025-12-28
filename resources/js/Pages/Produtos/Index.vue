<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    produtos: {
        type: Array,
        default: () => [],
    },
})
</script>

<template>
    <AppLayout>
        <div class="p-6 max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold">
                    Produtos
                </h1>
                <p class="text-gray-600">
                    Listagem de produtos cadastrados no sistema
                </p>
            </div>

            <!-- CARD -->
            <div class="card overflow-x-auto">
                <table class="w-full border-collapse">

                    <thead>
                        <tr class="bg-gray-100 text-left text-sm">
                            <th class="th">Fornecedor</th>
                            <th class="th">Referência</th>
                            <th class="th">Nome</th>
                            <th class="th">Cor</th>
                            <th class="th">Preço</th>
                            <th class="th">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="produto in produtos"
                            :key="produto.id"
                            class="border-t"
                        >
                            <td class="td">
                                {{ produto.fornecedor.nome }}
                            </td>

                            <td class="td">
                                {{ produto.referencia }}
                            </td>

                            <td class="td">
                                {{ produto.nome }}
                            </td>

                            <td class="td">
                                {{ produto.cor ?? '-' }}
                            </td>

                            <td class="td">
                                R$ {{ Number(produto.preco).toFixed(2) }}
                            </td>

                            <td class="td">
                                <span
                                    v-if="produto.status"
                                    class="badge badge-green"
                                >
                                    Ativo
                                </span>
                                <span
                                    v-else
                                    class="badge badge-red"
                                >
                                    Inativo
                                </span>
                            </td>
                        </tr>

                        <tr v-if="produtos.length === 0">
                            <td
                                colspan="6"
                                class="text-center p-6 text-gray-500"
                            >
                                Nenhum produto cadastrado.
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </AppLayout>
</template>

<style scoped>
.card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}

.th {
    padding: 12px;
    font-weight: 600;
    border-bottom: 1px solid #e5e7eb;
}

.td {
    padding: 12px;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 999px;
}

.badge-green {
    background: #dcfce7;
    color: #166534;
}

.badge-red {
    background: #fee2e2;
    color: #991b1b;
}
</style>
