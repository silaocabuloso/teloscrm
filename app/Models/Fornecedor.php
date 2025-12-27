<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    /**
     * Nome real da tabela no banco.
     * Laravel não pluraliza corretamente palavras em português.
     */
    protected $table = 'fornecedores';

    /**
     * Campos permitidos para mass assignment.
     */
    protected $fillable = [
        'nome',
        'email',
        'cnpj',
        'cep',
        'endereco',
        'status',
    ];
}
