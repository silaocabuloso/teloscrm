<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

// Props vindas do backend
defineProps({
    vendedores: {
        type: Array,
        default: () => [],
    },
    fornecedores: {
        type: Array,
        default: () => [],
    },
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
    <AppLayout>
        <div class="p-6 max-w-3xl mx-auto">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold">
                    Vínculo Vendedor × Fornecedor
                </h1>
                <p class="text-gray-600">
                    Associe um vendedor a um fornecedor para liberar acesso
                    a produtos, pedidos e API.
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <form @submit.prevent="submit" class="space-y-5">

                    <!-- VENDEDOR -->
                    <div>
                        <label class="label">
                            Vendedor
                        </label>
                        <select
                            v-model="form.user_id"
                            class="input"
                        >
                            <option value="">
                                Selecione um vendedor
                            </option>
                            <option
                                v-for="v in vendedores"
                                :key="v.id"
                                :value="v.id"
                            >
                                {{ v.name }} ({{ v.email }})
                            </option>
                        </select>

                        <p class="hint">
                            Apenas usuários do tipo vendedor aparecem aqui.
                        </p>
                    </div>

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
                    </div>

                    <!-- AÇÕES -->
                    <div class="flex gap-3 pt-2">
                        <button
                            type="submit"
                            class="btn-primary"
                            :disabled="form.processing"
                        >
                            Vincular
                        </button>

                        <button
                            type="button"
                            class="btn-secondary"
                            @click="$inertia.visit('/dashboard')"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>

            <!-- INFO -->
            <div class="info-box">
                <strong>Como funciona?</strong>
                <p>
                    Após o vínculo, o vendedor passa a enxergar apenas
                    os dados relacionados ao fornecedor vinculado:
                </p>
                <ul>
                    <li>• Produtos</li>
                    <li>• Pedidos</li>
                    <li>• Acesso à API</li>
                </ul>
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

.hint {
    font-size: 12px;
    color: #6b7280;
    margin-top: 4px;
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

.info-box ul {
    margin-top: 6px;
    padding-left: 12px;
}
</style>
