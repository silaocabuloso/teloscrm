<?php

namespace App\Http\Controllers;

use App\Jobs\EnviarRelatorioPedidosJob;

class RelatorioController extends Controller
{
    /**
     * Disparo manual do relatório de pedidos (últimos 7 dias)
     */
    public function enviarManual()
    {
        EnviarRelatorioPedidosJob::dispatch();

        return redirect()
            ->back()
            ->with('success', 'Relatório enviado por e-mail com sucesso!');
    }
}
