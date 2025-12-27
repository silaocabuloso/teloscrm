<?php

namespace App\Jobs;

use App\Mail\ProdutosImportadosMail;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProcessarProdutosCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $path;
    protected int $fornecedorId;
    protected User $user;

    /**
     * @param string $path Caminho do CSV
     * @param int $fornecedorId Fornecedor vinculado
     * @param User $user Usuário que enviou
     */
    public function __construct(string $path, int $fornecedorId, User $user)
    {
        $this->path = $path;
        $this->fornecedorId = $fornecedorId;
        $this->user = $user;
    }

    /**
     * Processa o CSV
     */
    public function handle(): void
    {
        $file = Storage::get($this->path);
        $lines = explode(PHP_EOL, $file);

        foreach ($lines as $line) {
            if (empty(trim($line))) {
                continue;
            }

            // CSV esperado: referencia,nome,cor,preco
            [$referencia, $nome, $cor, $preco] = str_getcsv($line);

            Produto::create([
                'fornecedor_id' => $this->fornecedorId,
                'referencia' => $referencia,
                'nome' => $nome,
                'cor' => $cor,
                'preco' => $preco,
                'status' => true,
            ]);
        }

        Mail::to($this->user->email)
            ->send(new ProdutosImportadosMail());
    }
}
