<script setup>
defineProps({ pedidos: Array })
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Pedidos</h1>

        <ul>
            <li v-for="p in pedidos" :key="p.id">
                {{ p.fornecedor.nome }} —
                {{ p.status }} —
                R$ {{ p.valor_total }}
            </li>
        </ul>
    </div>
</template>
