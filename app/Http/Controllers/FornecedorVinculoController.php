<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorVinculoController extends Controller
{
    /**
     * Exibe a tela de vínculo (somente admin).
     */
    public function index()
    {
        return inertia('Vinculos/Index', [
            // Lista apenas usuários vendedores
            'vendedores' => User::where('tipo', 'vendedor')->get(),

            // Lista todos os fornecedores
            'fornecedores' => Fornecedor::all(),
        ]);
    }

    /**
     * Salva o vínculo entre vendedor e fornecedor.
     */
    public function store(Request $request)
    {
        // Validação simples
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fornecedor_id' => 'required|exists:fornecedores,id',
        ]);

        // Busca o usuário vendedor
        $user = User::find($request->user_id);

        // Cria o vínculo sem remover os existentes
        $user->fornecedores()->syncWithoutDetaching(
            $request->fornecedor_id
        );

        return back()->with('success', 'Vínculo criado com sucesso.');
    }
}
