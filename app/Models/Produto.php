<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor_id',
        'referencia',
        'nome',
        'cor',
        'preco',
        'status',
    ];

    /**
     * Produto pertence a um fornecedor
     */
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
