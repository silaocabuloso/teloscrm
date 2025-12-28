<script setup>
import { onMounted, computed } from 'vue'
import Chart from 'chart.js/auto'
import Navbar from '@/Components/Navbar.vue'

const props = defineProps({
    totalPedidos: {
        type: Number,
        default: 0,
    },
    valorTotalPedidos: {
        type: Number,
        default: 0,
    },
    statusResumo: {
        type: Object,
        default: () => ({}),
    },
})

/**
 * Computeds seguros (evitam undefined)
 */
const labels = computed(() =>
    Object.keys(props.statusResumo || {})
)

const values = computed(() =>
    Object.values(props.statusResumo || {})
)

onMounted(() => {
    if (labels.value.length === 0) {
        return
    }

    const ctx = document.getElementById('statusChart')
    if (!ctx) return

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.value,
            datasets: [
                {
                    label: 'Pedidos por status',
                    data: values.value,
                    backgroundColor: ['#3b82f6', '#10b981', '#ef4444'],
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    })
})
</script>

<template>
    <Navbar />

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">
            Dashboard
        </h1>

        <!-- INDICADORES -->
        <div class="grid grid-cols-3 gap-6 mb-10">
            <div class="box">
                <p class="label">Total de pedidos</p>
                <p class="value">{{ totalPedidos }}</p>
            </div>

            <div class="box">
                <p class="label">Valor total</p>
                <p class="value">
                    R$ {{ Number(valorTotalPedidos).toFixed(2) }}
                </p>
            </div>

            <div class="box">
                <p class="label mb-2">Pedidos por status</p>

                <div v-if="labels.length" class="chart-box">
                    <canvas id="statusChart"></canvas>
                </div>

                <p
                    v-else
                    class="text-sm text-gray-500 mt-2"
                >
                    Nenhum pedido encontrado.
                </p>
            </div>
        </div>

   


    </div>
</template>

<style scoped>
.box {
    background: white;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.label {
    font-size: 14px;
    color: #6b7280;
}

.value {
    font-size: 24px;
    font-weight: bold;
}

.chart-box {
    height: 200px;
}

.shortcut {
    background: #1f2937;
    color: white;
    padding: 12px;
    border-radius: 6px;
    text-align: center;
}
</style>
