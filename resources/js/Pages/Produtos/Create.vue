<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
    fornecedores: {
        type: Array,
        default: () => [],
    },
})

const form = useForm({
    fornecedor_id: '',
    referencia: '',
    nome: '',
    cor: '',
    preco: '',
})

function submit() {
    form.post(route('produtos.store'))
}
</script>

<template>
    <AppLayout>
        <div class="p-6 max-w-3xl mx-auto">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold">Novo Produto</h1>
                <p class="text-gray-600">
                    Cadastro manual de produto
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <form @submit.prevent="submit" class="space-y-5">

                    <!-- FORNECEDOR -->
                    <div>
                        <label class="label">Fornecedor</label>
                        <select
                            v-model="form.fornecedor_id"
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
                        <span
                            v-if="form.errors.fornecedor_id"
                            class="error"
                        >
                            {{ form.errors.fornecedor_id }}
                        </span>
                    </div>

                    <!-- REFERÊNCIA -->
                    <div>
                        <label class="label">Referência</label>
                        <input
                            v-model="form.referencia"
                            class="input"
                            placeholder="Ex: PROD-001"
                        />
                    </div>

                    <!-- NOME -->
                    <div>
                        <label class="label">Nome do produto</label>
                        <input
                            v-model="form.nome"
                            class="input"
                            placeholder="Nome do produto"
                        />
                        <span
                            v-if="form.errors.nome"
                            class="error"
                        >
                            {{ form.errors.nome }}
                        </span>
                    </div>

                    <!-- COR -->
                    <div>
                        <label class="label">Cor</label>
                        <input
                            v-model="form.cor"
                            class="input"
                            placeholder="Opcional"
                        />
                    </div>

                    <!-- PREÇO -->
                    <div>
                        <label class="label">Preço</label>
                        <input
                            v-model="form.preco"
                            type="number"
                            step="0.01"
                            class="input"
                            placeholder="0.00"
                        />
                        <span
                            v-if="form.errors.preco"
                            class="error"
                        >
                            {{ form.errors.preco }}
                        </span>
                    </div>

                    <!-- AÇÕES -->
                    <div class="flex justify-end gap-3 pt-4">
                        <button
                            type="submit"
                            class="btn-primary"
                            :disabled="form.processing"
                        >
                            Salvar Produto
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>

<style scoped>
.card {
    background: white;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 24px;
}

/* Inputs */
.label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 4px;
    color: #374151;
}

.input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
}

.input:focus {
    outline: none;
    border-color: #2563eb;
}

/* Botões */
.btn-primary {
    background: #2563eb;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
}

.btn-primary:hover {
    background: #1d4ed8;
}

.btn-primary:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Erros */
.error {
    font-size: 12px;
    color: #dc2626;
    margin-top: 4px;
    display: block;
}
</style>
