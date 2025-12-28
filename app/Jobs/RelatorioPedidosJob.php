<?php

namespace App\Jobs;

use App\Models\Pedido;
use App\Mail\RelatorioPedidosMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RelatorioPedidosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Executa o job.
     * Aqui é onde o relatório é gerado.
     */
    public function handle(): void
    {
        // Busca pedidos dos últimos 7 dias
        $pedidos = Pedido::whereDate('created_at', '>=', now()->subDays(7))
            ->get();

        // Agrupa pedidos por status (pendente, concluido, cancelado)
        $resumo = $pedidos->groupBy('status')->map(function ($grupo) {
            return [
                'quantidade' => $grupo->count(),
                'valor_total' => $grupo->sum('valor_total'),
            ];
        });

        // Envia o email
        Mail::to('admin@teloscrm.com')
            ->send(new RelatorioPedidosMail($resumo));
    }
}
