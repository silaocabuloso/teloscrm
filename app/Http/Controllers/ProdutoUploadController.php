<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessarProdutosCsvJob;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class ProdutoUploadController extends Controller
{
    /**
     * Tela de upload
     */
    public function create()
    {
        $user = auth()->user();

        $fornecedores = $user->isAdmin()
            ? Fornecedor::all()
            : $user->fornecedores;

        return inertia('Produtos/Upload', [
            'fornecedores' => $fornecedores,
        ]);
    }

    /**
     * Recebe o CSV e dispara o Job
     */
    public function store(Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'arquivo' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('arquivo')->store('csv');

        ProcessarProdutosCsvJob::dispatch(
            $path,
            $request->fornecedor_id,
            auth()->user()
        );

        return redirect()
            ->route('produtos.index')
            ->with('success', 'CSV enviado. Processamento em andamento.');
    }
}
