<?php

namespace App\Http\Controllers;

use App\Jobs\RelatorioPedidosJob;

class RelatorioController extends Controller
{
    /**
     * Disparo manual do relatório
     */
    public function enviar()
    {
        RelatorioPedidosJob::dispatch();

        return back()->with('success', 'Relatório enviado com sucesso!');
    }
}
