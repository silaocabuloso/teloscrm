<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ProdutosImportadosMail extends Mailable
{
    public function build()
    {
        return $this->subject('Importação de produtos concluída')
            ->view('emails.produtos_importados');
    }
}
