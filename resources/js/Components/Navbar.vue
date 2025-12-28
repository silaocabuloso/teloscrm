<script setup>
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth.user

function go(url) {
    router.visit(url)
}

function logout() {
    router.post('/logout')
}
</script>

<template>
    <header class="navbar">
        <!-- LOGO -->
        <div class="left">
            <span class="logo">Mini ERP</span>

            <nav class="menu">
                <button @click="go('/dashboard')">Dashboard</button>
                <button @click="go('/fornecedores')">Fornecedores</button>
                <button @click="go('/fornecedores/create')">Novo Fornecedor</button>
                <button @click="go('/produtos')">Produtos</button>
                <button @click="go('/produtos/create')">Novo Produto</button>
                <button @click="go('/pedidos')">Pedidos</button>
                <button @click="go('/pedidos/create')">Novo Pedido</button>
            
                <button @click="go('/produtos/upload')">Upload CSV Produtos</button>

                <!-- ADMIN -->
                <button
                    v-if="user.tipo === 'admin'"
                    @click="go('/vinculos')"
                >
                    Vínculos
                </button>
            </nav>
        </div>

        <!-- USUÁRIO -->
        <div class="right">
            <span class="user">
                {{ user.name }} ({{ user.tipo }})
            </span>

            <button class="logout" @click="logout">
                Sair
            </button>
        </div>
    </header>
</template>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 64px;
    padding: 0 24px;
    background-color: #111827; /* cinza escuro */
    color: #ffffff;
    border-bottom: 1px solid #1f2937;
}

/* LADO ESQUERDO */
.left {
    display: flex;
    align-items: center;
    gap: 32px;
}

.logo {
    font-size: 18px;
    font-weight: 600;
    color: #60a5fa; /* azul suave */
}

/* MENU */
.menu {
    display: flex;
    gap: 16px;
}

.menu button {
    background: none;
    border: none;
    color: #e5e7eb;
    font-size: 14px;
    cursor: pointer;
}

.menu button:hover {
    color: #60a5fa;
}

/* LADO DIREITO */
.right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.user {
    font-size: 13px;
    color: #d1d5db;
}

.logout {
    background-color: #ef4444;
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 13px;
    cursor: pointer;
}

.logout:hover {
    background-color: #dc2626;
}
</style>
