<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoApiController extends Controller
{
    /**
     * Lista pedidos por CNPJ do fornecedor
     */
    public function pedidosPorFornecedor(string $cnpj)
    {
        $fornecedor = Fornecedor::where('cnpj', $cnpj)->firstOrFail();
        $user = auth()->user();

        // Regra de acesso
        if (
            !$user->isAdmin() &&
            !$user->fornecedores->contains($fornecedor->id)
        ) {
            abort(403);
        }

        return response()->json(
            $fornecedor->pedidos()->with('produtos')->get()
        );
    }

    /**
     * Detalhe de um pedido
     */
    public function show(Pedido $pedido)
    {
        return response()->json(
            $pedido->load('fornecedor', 'produtos')
        );
    }

    /**
     * Criar pedido via API
     */
    public function store(Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'produtos' => 'required|array',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        // Cria pedido
        $pedido = Pedido::create([
            'fornecedor_id' => $request->fornecedor_id,
            'data_pedido' => now(),
            'status' => 'pendente',
            'valor_total' => 0,
        ]);

        $total = 0;

        // Relaciona produtos
        foreach ($request->produtos as $item) {
            $produto = Produto::find($item['id']);

            $pedido->produtos()->attach($produto->id, [
                'quantidade' => $item['quantidade'],
                'valor_unitario' => $produto->preco,
            ]);

            $total += $produto->preco * $item['quantidade'];
        }

        $pedido->update(['valor_total' => $total]);

        return response()->json($pedido, 201);
    }

    /**
     * Atualiza status do pedido
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'status' => 'required|in:pendente,concluido,cancelado',
        ]);

        $pedido->update([
            'status' => $request->status,
        ]);

        return response()->json($pedido);
    }

    /**
     * Remove pedido
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json([
            'message' => 'Pedido removido com sucesso',
        ]);
    }
}
