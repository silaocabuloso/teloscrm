<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

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
    <AppLayout>
        <div class="p-6 max-w-3xl mx-auto">

            <!-- HEADER -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold">
                    Novo Fornecedor
                </h1>
                <p class="text-gray-600">
                    Preencha os dados para cadastrar um novo fornecedor
                </p>
            </div>

            <!-- CARD -->
            <div class="card">
                <form @submit.prevent="submit" class="space-y-5">

                    <!-- NOME -->
                    <div>
                        <label class="label">Nome</label>
                        <input
                            v-model="form.nome"
                            type="text"
                            class="input"
                        />
                        <p v-if="form.errors.nome" class="error">
                            {{ form.errors.nome }}
                        </p>
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="label">Email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            class="input"
                        />
                        <p v-if="form.errors.email" class="error">
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <!-- CNPJ -->
                    <div>
                        <label class="label">CNPJ</label>
                        <input
                            v-model="form.cnpj"
                            type="text"
                            maxlength="14"
                            class="input"
                        />
                        <p v-if="form.errors.cnpj" class="error">
                            {{ form.errors.cnpj }}
                        </p>
                    </div>

                    <!-- CEP -->
                    <div>
                        <label class="label">CEP</label>
                        <input
                            v-model="form.cep"
                            type="text"
                            maxlength="8"
                            class="input"
                        />
                        <p v-if="form.errors.cep" class="error">
                            {{ form.errors.cep }}
                        </p>
                    </div>

                    <!-- ENDEREÇO -->
                    <div>
                        <label class="label">Endereço</label>
                        <input
                            v-model="form.endereco"
                            type="text"
                            class="input"
                        />
                        <p v-if="form.errors.endereco" class="error">
                            {{ form.errors.endereco }}
                        </p>
                    </div>

                    <!-- AÇÕES -->
                    <div class="flex gap-3 pt-4">
                        <button
                            type="submit"
                            class="btn-primary"
                            :disabled="form.processing"
                        >
                            Salvar fornecedor
                        </button>

                        <Link
                            :href="route('fornecedores.index')"
                            class="btn-secondary"
                        >
                            Cancelar
                        </Link>
                    </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>

<style scoped>
.card {
    background: white;
    padding: 24px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.label {
    display: block;
    font-weight: 500;
    margin-bottom: 4px;
}

.input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 10px;
}

.input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 1px #2563eb;
}

.error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 4px;
}

.btn-primary {
    background: #2563eb;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
}

.btn-primary:hover {
    background: #1d4ed8;
}

.btn-secondary {
    padding: 10px 16px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background: white;
}

.btn-secondary:hover {
    background: #f3f4f6;
}
</style>
