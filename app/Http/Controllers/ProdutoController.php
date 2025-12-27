<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Lista produtos (com regra de acesso)
     */
   public function index()
{
    $user = auth()->user();

    if ($user->isAdmin()) {
        $produtos = Produto::with('fornecedor')->get();
    } else {
        $fornecedoresIds = $user->fornecedores->pluck('id');

        $produtos = Produto::with('fornecedor')
            ->whereIn('fornecedor_id', $fornecedoresIds)
            ->get();
    }

    return inertia('Produtos/Index', [
        'produtos' => $produtos,
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

        return inertia('Produtos/Create', [
            'fornecedores' => $fornecedores,
        ]);
    }

    /**
     * Salva produto
     */
    public function store(Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'referencia' => 'required|string|max:50',
            'nome' => 'required|string|max:255',
            'cor' => 'nullable|string|max:50',
            'preco' => 'required|numeric|min:0',
        ]);

        Produto::create([
            'fornecedor_id' => $request->fornecedor_id,
            'referencia' => $request->referencia,
            'nome' => $request->nome,
            'cor' => $request->cor,
            'preco' => $request->preco,
            'status' => true,
        ]);

        return redirect()->route('produtos.index');
    }
}
