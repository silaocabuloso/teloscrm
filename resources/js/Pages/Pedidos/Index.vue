<script setup>
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    pedidos: {
        type: Array,
        default: () => [],
    },
})

function formatarData(data) {
    if (!data) return '-'
    return new Date(data).toLocaleDateString('pt-BR')
}

function formatarValor(valor) {
    return Number(valor).toFixed(2)
}

/**
 * Disparo manual do relatório de pedidos (últimos 7 dias)
 */
function enviarRelatorio() {
    if (!confirm('Deseja enviar por e-mail o relatório dos pedidos dos últimos 7 dias?')) {
        return
    }

    router.post(route('pedidos.relatorio.manual'), {}, {
        preserveScroll: true,
    })
}
</script>

<template>
    <AppLayout>
        <div class="p-6 max-w-6xl mx-auto">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Pedidos</h1>
                    <p class="text-gray-600">
                        Listagem de pedidos cadastrados no sistema
                    </p>
                </div>

                <!-- BOTÃO RELATÓRIO MANUAL -->
                <button
                    @click="enviarRelatorio"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
                >
                    Enviar relatório (7 dias)
                </button>
            </div>

            <!-- TABELA -->
            <div class="card">
                <table class="w-full">
                    <thead>
                        <tr class="thead">
                            <th>#</th>
                            <th>Fornecedor</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th class="text-right">Valor Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="pedido in pedidos"
                            :key="pedido.id"
                            class="row"
                        >
                            <td>
                                {{ pedido.id }}
                            </td>

                            <td>
                                {{ pedido.fornecedor?.nome ?? '-' }}
                            </td>

                            <td>
                                <span
                                    class="status"
                                    :class="pedido.status"
                                >
                                    {{ pedido.status }}
                                </span>
                            </td>

                            <td>
                                {{ formatarData(pedido.data_pedido ?? pedido.created_at) }}
                            </td>

                            <td class="text-right font-semibold">
                                R$ {{ formatarValor(pedido.valor_total) }}
                            </td>
                        </tr>

                        <tr v-if="pedidos.length === 0">
                            <td colspan="5" class="empty">
                                Nenhum pedido encontrado.
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
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

/* Header da tabela */
.thead {
    background: #f9fafb;
}

th {
    padding: 12px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    border-bottom: 1px solid #e5e7eb;
}

/* Linhas */
.row td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

.row:hover {
    background: #f9fafb;
}

/* Status */
.status {
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    text-transform: capitalize;
}

.status.pendente {
    background: #fef3c7;
    color: #92400e;
}

.status.concluido {
    background: #dcfce7;
    color: #166534;
}

.status.cancelado {
    background: #fee2e2;
    color: #991b1b;
}

/* Empty */
.empty {
    padding: 24px;
    text-align: center;
    color: #6b7280;
}
</style>
