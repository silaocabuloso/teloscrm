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
    arquivo: null,
})

function submit() {
    form.post(route('produtos.upload'), {
        forceFormData: true,
    })
}
</script>

<template>
    <AppLayout>
        <div class="p-6 max-w-3xl mx-auto">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold">
                    Upload de Produtos (CSV)
                </h1>
                <p class="text-gray-600">
                    Envie um arquivo CSV para cadastrar produtos em massa
                    para um fornecedor específico.
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <form @submit.prevent="submit" class="space-y-5">

                    <!-- FORNECEDOR -->
                    <div>
                        <label class="label">
                            Fornecedor
                        </label>
                        <select
                            v-model="form.fornecedor_id"
                            class="input"
                        >
                            <option value="">
                                Selecione um fornecedor
                            </option>
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

                    <!-- ARQUIVO -->
                    <div>
                        <label class="label">
                            Arquivo CSV
                        </label>
                        <input
                            type="file"
                            accept=".csv"
                            class="input-file"
                            @change="e => form.arquivo = e.target.files[0]"
                        />

                        <span
                            v-if="form.errors.arquivo"
                            class="error"
                        >
                            {{ form.errors.arquivo }}
                        </span>
                    </div>

                    <!-- AÇÕES -->
                    <div class="flex gap-3 pt-2">
                        <button
                            type="submit"
                            class="btn-primary"
                            :disabled="form.processing"
                        >
                            Enviar CSV
                        </button>

                        <button
                            type="button"
                            class="btn-secondary"
                            @click="$inertia.visit('/produtos')"
                        >
                            Voltar
                        </button>
                    </div>
                </form>
            </div>

            <!-- INSTRUÇÕES -->
            <div class="info-box">
                <strong>Formato esperado do CSV:</strong>

                <pre>
fornecedor_id,nome,cor,preco
3,Produto A,Azul,10.50
3,Produto B,Vermelho,20.00
                </pre>

                <p>
                    • O processamento ocorre em background (Job)<br />
                    • O status pode ser acompanhado via sistema<br />
                    • Um email é enviado informando do término do processamento<br />
                    • Os produtos aparecerão automaticamente na listagem
                </p>
            </div>

        </div>
    </AppLayout>
</template>

<style scoped>
.card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 24px;
}

.label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 6px;
    color: #374151;
}

.input {
    width: 100%;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
}

.input-file {
    width: 100%;
    padding: 8px;
    border: 1px dashed #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    background: #f9fafb;
}

.error {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: #dc2626;
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
    background: white;
}

.info-box {
    margin-top: 20px;
    background: #f9fafb;
    border: 1px dashed #d1d5db;
    border-radius: 8px;
    padding: 16px;
    font-size: 14px;
    color: #374151;
}

pre {
    background: #111827;
    color: #e5e7eb;
    padding: 12px;
    border-radius: 6px;
    font-size: 13px;
    margin-top: 8px;
}
</style>
