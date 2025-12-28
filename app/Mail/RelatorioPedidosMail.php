<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RelatorioPedidosMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $resumo;

    /**
     * Recebe o resumo do relatório
     */
    public function __construct(array $resumo)
    {
        $this->resumo = $resumo;
    }

    /**
     * Monta o email
     */
    public function build()
    {
        return $this->subject('Relatório diário de pedidos')
            ->view('emails.relatorio-pedidos');
    }
}
