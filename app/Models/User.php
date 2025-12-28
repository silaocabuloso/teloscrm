<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Fornecedor;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Verifica se o usuário é administrador
     */
    public function isAdmin(): bool
    {
        return $this->tipo === 'admin';
    }

    /**
     * Verifica se o usuário está ativo
     */
    public function isAtivo(): bool
    {
        return (bool) $this->status;
    }

    /**
     * Relacionamento N:N
     * Um usuário (vendedor) pode estar vinculado a vários fornecedores
     */
    public function fornecedores()
    {
        return $this->belongsToMany(Fornecedor::class);
    }
}
