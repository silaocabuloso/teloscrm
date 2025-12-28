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

       /**
     * Relacionamento N:N
     * Um usuário (vendedor) pode estar vinculado a vários fornecedores.
     */
    public function fornecedores()
    {
        return $this->belongsToMany(
            \App\Models\Fornecedor::class
        );
    }
    public function usuarios()
{
    return $this->belongsToMany(User::class);
}

/**
 * Um fornecedor possui vários produtos
 */
public function produtos()
{
    return $this->hasMany(Produto::class);
}

public function pedidos()
{
    return $this->hasMany(Pedido::class);
}


}

