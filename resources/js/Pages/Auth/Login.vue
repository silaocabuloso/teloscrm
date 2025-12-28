<script setup>
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post(route('login'))
}
</script>

<template>
    <Head title="Login" />

    <div class="min-h-screen flex">
        <!-- COLUNA ESQUERDA -->
        <div class="hidden lg:flex w-1/2 bg-gray-900 text-white items-center justify-center p-10">
            <div class="text-center space-y-6">
                <h1 class="text-4xl font-bold">Mini ERP</h1>

                <p class="text-gray-300 text-lg">
                    Sistema de pedidos para fornecedores
                </p>

           

                <p class="text-sm text-gray-400">
                    Laravel • Vue • Docker • API • Jobs
                </p>
            </div>
        </div>

        <!-- COLUNA DIREITA -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50">
            <div class="w-full max-w-md p-8 bg-white rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    Acesso ao sistema
                </h2>

                <p class="text-gray-500 mb-6">
                    Entre com suas credenciais
                </p>

                <form @submit.prevent="submit" class="space-y-4">
                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Email
                        </label>

                        <input
                            v-model="form.email"
                            type="email"
                            class="mt-1 w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        />
                    </div>

                    <!-- SENHA -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Senha
                        </label>

                        <input
                            v-model="form.password"
                            type="password"
                            class="mt-1 w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required
                        />
                    </div>

                    <!-- ERRO -->
                    <div
                        v-if="form.errors.email"
                        class="text-sm text-red-600"
                    >
                        {{ form.errors.email }}
                    </div>

                    <!-- BOTÃO -->
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded transition"
                    >
                        Entrar
                    </button>
                </form>

                <p class="text-xs text-center text-gray-400 mt-6">
                    © Mini ERP — Teste Técnico Full Stack
                </p>
            </div>
        </div>
    </div>
</template>
