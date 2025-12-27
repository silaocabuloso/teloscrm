<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request; 
use App\Models\Fornecedor;
use App\Http\Requests\StoreFornecedorRequest;
use Illuminate\Support\Facades\Http;

class FornecedorController extends Controller
{
    /**
     * Lista os fornecedores.
     */
public function index()
{
    // Usuário logado
    $user = auth()->user();

    // Se for administrador, pode ver todos os fornecedores
    if ($user->isAdmin()) {
        $fornecedores = Fornecedor::all();
    } 
    // Se for vendedor, vê apenas os fornecedores vinculados a ele
    else {
        $fornecedores = $user->fornecedores;
    }

    return inertia('Fornecedores/Index', [
        'fornecedores' => $fornecedores,
    ]);
}


    /**
     * Exibe formulário de criação.
     */
    public function create()
    {
        return inertia('Fornecedores/Create');
    }

    /**
     * Salva um novo fornecedor.
     */
public function store(Request $request)
{
    $data = $request->validate([
        'nome'     => 'required|string|max:255',
        'email'    => 'nullable|email|max:255',
        'cnpj'     => 'required|string|size:14|unique:fornecedores,cnpj',
        'cep'      => 'required|string|size:8',
        'endereco' => 'required|string|max:255',
    ]);

    $data['status'] = true;

    Fornecedor::create($data);

    return redirect()
        ->route('fornecedores.index')
        ->with('success', 'Fornecedor cadastrado com sucesso!');
}


    /**
 * Alterna o status do fornecedor (ativo / inativo).
 */
public function toggleStatus(Fornecedor $fornecedor)
{
    $fornecedor->status = !$fornecedor->status;
    $fornecedor->save();

    return redirect()->route('fornecedores.index');
}

/**
 * Formulário de edição
 */
public function edit(Fornecedor $fornecedor)
{
    return Inertia::render('Fornecedores/Edit', [
        'fornecedor' => $fornecedor,
    ]);
}

/**
 * Atualiza fornecedor
 */
public function update(Request $request, Fornecedor $fornecedor)
{
    $dados = $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'cnpj' => 'required|string|max:20',
        'cep' => 'required|string|max:10',
        'endereco' => 'required|string|max:255',
        'status' => 'boolean',
    ]);

    $fornecedor->update($dados);

    return redirect()
        ->route('fornecedores.index')
        ->with('success', 'Fornecedor atualizado com sucesso.');
}


}
