<?php

namespace App\Jobs;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarRelatorioPedidosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Executa o job
     */
    public function handle(): void
    {
        // Busca pedidos dos últimos 7 dias
        $pedidos = Pedido::whereDate(
            'created_at',
            '>=',
            now()->subDays(7)
        )->with('fornecedor')->get();

        // Envia email simples (Mailpit)
        Mail::raw(
            $this->montarMensagem($pedidos),
            function ($message) {
                $message
                    ->to('admin@teloscrm.com')
                    ->subject('Relatório de Pedidos - Últimos 7 dias');
            }
        );
    }

    /**
     * Monta o texto do relatório
     */
    private function montarMensagem($pedidos): string
    {
        if ($pedidos->isEmpty()) {
            return 'Nenhum pedido encontrado nos últimos 7 dias.';
        }

        $texto = "Relatório de pedidos (últimos 7 dias)\n\n";

        foreach ($pedidos as $pedido) {
            $texto .= sprintf(
                "Pedido #%d | %s | %s | R$ %.2f\n",
                $pedido->id,
                $pedido->fornecedor->nome ?? 'Fornecedor',
                ucfirst($pedido->status),
                $pedido->valor_total
            );
        }

        return $texto;
    }
}
