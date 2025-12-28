<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'fornecedor_id',
        'data_pedido',
        'status',
        'valor_total',
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)
            ->withPivot(['quantidade', 'valor_unitario'])
            ->withTimestamps();
    }
}
