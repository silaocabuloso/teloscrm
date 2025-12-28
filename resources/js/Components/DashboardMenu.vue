<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
        <Link href="/fornecedores" class="card">Fornecedores</Link>
        <Link href="/produtos" class="card">Produtos</Link>
        <Link href="/pedidos" class="card">Pedidos</Link>
        <Link href="/produtos/upload" class="card">Upload CSV</Link>
 
    </div>
</template>

<style scoped>
.card {
    padding: 20px;
    border: 1px solid #ddd;
    text-align: center;
    font-weight: bold;
    border-radius: 6px;
}
</style>
