<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class DashboardController extends Controller
{
    /**
     * Dashboard principal do sistema
     */
public function index()
{
    $user = auth()->user();
    $user->load('fornecedores');

    $query = \App\Models\Pedido::query();

    if (!$user->isAdmin()) {
        $query->whereIn(
            'fornecedor_id',
            $user->fornecedores->pluck('id')
        );
    }

    $pedidos = $query->get();

    return inertia('Dashboard', [
        'totalPedidos' => $pedidos->count(),
        'valorTotalPedidos' => (float) $pedidos->sum('valor_total'),
        'statusResumo' => $pedidos
            ->groupBy('status')
            ->map(fn ($grupo) => $grupo->count()),
    ]);
}


}
