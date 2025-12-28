<script setup>
import { router } from '@inertiajs/vue3'

function go(url) {
    router.visit(url)
}
</script>

<template>
    <nav class="navbar">
        <div class="logo">TelosCRM</div>

        <ul class="menu">
            <li>
                <button @click="go('/dashboard')">
                    Dashboard
                </button>
            </li>

            <li>
                <button @click="go('/fornecedores')">
                    Fornecedores
                </button>
            </li>

            <li>
                <button @click="go('/produtos')">
                    Produtos
                </button>
            </li>

           
            <li>
                <button @click="go('/produtos/create')">
                    Novo Produto
                </button>
            </li>

          
            <li>
                <button @click="go('/pedidos')">
                    Pedidos
                </button>
            </li>
 <li>
                <button @click="go('/pedidos/create')">
                    Novo Pedido
                </button>
            </li>


            <li>
                <button @click="go('/produtos/upload')">
                    Upload CSV
                </button>
            </li>

            <!-- ADMIN -->
            <li>
                <button @click="go('/vinculos')">
                    Vínculo Vendedor / Fornecedor
                </button>
            </li>
        </ul>
    </nav>
</template>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #1f2937;
    padding: 12px 24px;
    color: white;
}

.logo {
    font-weight: bold;
    font-size: 16px;
}

.menu {
    display: flex;
    gap: 16px;
}

.menu button {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

.menu button:hover {
    text-decoration: underline;
}
</style>
