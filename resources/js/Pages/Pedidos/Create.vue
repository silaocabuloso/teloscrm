<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import axios from 'axios'
import { computed } from 'vue'

defineProps({
    fornecedores: {
        type: Array,
        default: () => [],
    },
})

const form = useForm({
    fornecedor_id: '',
    produtos: [],
})

/**
 * Carrega produtos do fornecedor selecionado
 */
async function carregarProdutos() {
    if (!form.fornecedor_id) {
        form.produtos = []
        return
    }

    const res = await axios.get(
        `/fornecedores/${form.fornecedor_id}/produtos`
    )

    form.produtos = res.data.map(p => ({
        id: p.id,
        nome: p.nome,
        cor: p.cor,
        preco: Number(p.preco),
        quantidade: 1,
    }))
}

/**
 * Total geral do pedido
 */
const totalPedido = computed(() => {
    return form.produtos.reduce((total, p) => {
        return total + p.preco * p.quantidade
    }, 0)
})

function submit() {
    form.post(route('pedidos.store'))
}
</script>

<template>
    <AppLayout>
        <div class="p-6 max-w-6xl mx-auto">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Novo Pedido</h1>
                <p class="text-gray-600">
                    Selecione um fornecedor e os produtos desejados
                </p>
            </div>

            <!-- FORNECEDOR -->
            <div class="mb-6 max-w-md">
                <label class="label">Fornecedor</label>
                <select
                    v-model="form.fornecedor_id"
                    @change="carregarProdutos"
                    class="input"
                >
                    <option value="">Selecione um fornecedor</option>
                    <option
                        v-for="f in fornecedores"
                        :key="f.id"
                        :value="f.id"
                    >
                        {{ f.nome }}
                    </option>
                </select>
            </div>

            <!-- PRODUTOS -->
            <div
                v-if="form.produtos.length > 0"
                class="card"
            >
                <table class="w-full">
                    <thead>
                        <tr class="thead">
                            <th>Produto</th>
                            <th>Cor</th>
                            <th class="text-right">Preço</th>
                            <th class="text-center">Qtd</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="p in form.produtos"
                            :key="p.id"
                            class="row"
                        >
                            <td>{{ p.nome }}</td>
                            <td>{{ p.cor ?? '-' }}</td>

                            <td class="text-right">
                                R$ {{ p.preco.toFixed(2) }}
                            </td>

                            <td class="text-center">
                                <input
                                    type="number"
                                    min="1"
                                    v-model="p.quantidade"
                                    class="qtd"
                                />
                            </td>

                            <td class="text-right font-semibold">
                                R$
                                {{ (p.preco * p.quantidade).toFixed(2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- TOTAL -->
            <div
                v-if="form.produtos.length > 0"
                class="total"
            >
                <span>Total do pedido</span>
                <strong>
                    R$ {{ totalPedido.toFixed(2) }}
                </strong>
            </div>

            <!-- AÇÕES -->
            <div class="mt-6 flex gap-3">
                <button
                    @click="submit"
                    class="btn-primary"
                    :disabled="form.processing"
                >
                    Salvar Pedido
                </button>

                <button
                    @click="$inertia.visit('/pedidos')"
                    class="btn-secondary"
                >
                    Cancelar
                </button>
            </div>

        </div>
    </AppLayout>
</template>

<style scoped>
.card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    margin-top: 16px;
}

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

.row td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

.row:hover {
    background: #f9fafb;
}

.input {
    width: 100%;
    padding: 8px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
}

.label {
    display: block;
    font-size: 14px;
    margin-bottom: 4px;
    color: #374151;
}

.qtd {
    width: 70px;
    text-align: center;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    padding: 4px;
}

.total {
    margin-top: 16px;
    display: flex;
    justify-content: flex-end;
    gap: 16px;
    font-size: 18px;
}

.btn-primary {
    background: #2563eb;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
}

.btn-primary:hover {
    background: #1d4ed8;
}

.btn-secondary {
    border: 1px solid #d1d5db;
    padding: 10px 20px;
    border-radius: 6px;
}
</style>
