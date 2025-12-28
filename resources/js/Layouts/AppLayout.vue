<script setup>
import Navbar from '@/Components/Navbar.vue'
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- NAVBAR GLOBAL -->
        <Navbar />

        <!-- CONTEÚDO DAS PÁGINAS -->
        <main class="max-w-7xl mx-auto">
            <slot />
        </main>
    </div>
</template>
