<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendedorUserSeeder extends Seeder
{
    /**
     * Cria um usuário vendedor padrão.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'vendedor@teloscrm.com'],
            [
                'name' => 'Vendedor Teste',
                'password' => Hash::make('password'),
                'tipo' => 'vendedor',
                'status' => true,
            ]
        );
    }
}
