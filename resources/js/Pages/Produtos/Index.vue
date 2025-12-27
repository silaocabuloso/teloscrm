<script setup>
defineProps({
    produtos: {
        type: Array,
        default: () => [],
    },
})
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Produtos</h1>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Fornecedor</th>
                    <th class="border p-2">Referência</th>
                    <th class="border p-2">Nome</th>
                    <th class="border p-2">Cor</th>
                    <th class="border p-2">Preço</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="produto in produtos"
                    :key="produto.id"
                >
                    <td class="border p-2">
                        {{ produto.fornecedor.nome }}
                    </td>

                    <td class="border p-2">
                        {{ produto.referencia }}
                    </td>

                    <td class="border p-2">
                        {{ produto.nome }}
                    </td>

                    <td class="border p-2">
                        {{ produto.cor ?? '-' }}
                    </td>

                    <td class="border p-2">
                        R$ {{ Number(produto.preco).toFixed(2) }}
                    </td>

                    <td class="border p-2">
                        <span
                            v-if="produto.status"
                            class="text-green-600 font-semibold"
                        >
                            Ativo
                        </span>
                        <span
                            v-else
                            class="text-red-600 font-semibold"
                        >
                            Inativo
                        </span>
                    </td>
                </tr>

                <tr v-if="produtos.length === 0">
                    <td
                        colspan="6"
                        class="text-center p-4 text-gray-500"
                    >
                        Nenhum produto cadastrado.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
