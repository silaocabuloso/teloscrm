<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PedidoController extends Controller
{
    /**
     * Listagem de pedidos
     */
    public function index()
    {
        $user = auth()->user();

        $query = Pedido::with('fornecedor');

        if (!$user->isAdmin()) {
            $query->whereIn(
                'fornecedor_id',
                $user->fornecedores->pluck('id')
            );
        }

        return inertia('Pedidos/Index', [
            'pedidos' => $query->get(),
        ]);
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        $user = auth()->user();

        $fornecedores = $user->isAdmin()
            ? Fornecedor::all()
            : $user->fornecedores;

        return inertia('Pedidos/Create', [
            'fornecedores' => $fornecedores,
        ]);
    }

    /**
     * Salvar pedido
     */
    public function store(Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'produtos' => 'required|array',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        $pedido = Pedido::create([
            'fornecedor_id' => $request->fornecedor_id,
            'data_pedido' => now(),
            'status' => 'pendente',
            'valor_total' => 0,
        ]);

        $total = 0;

        foreach ($request->produtos as $item) {
            $produto = Produto::find($item['id']);

            $pedido->produtos()->attach($produto->id, [
                'quantidade' => $item['quantidade'],
                'valor_unitario' => $produto->preco,
            ]);

            $total += $produto->preco * $item['quantidade'];
        }

        $pedido->update(['valor_total' => $total]);

        return redirect()->route('pedidos.index');
    }

    /**
     * Produtos por fornecedor (CACHE)
     */
    public function produtosPorFornecedor(Fornecedor $fornecedor)
    {
        $produtos = Cache::remember(
            "fornecedor_{$fornecedor->id}_produtos",
            3600,
            fn () => $fornecedor->produtos
        );

        return response()->json($produtos);
    }
}
