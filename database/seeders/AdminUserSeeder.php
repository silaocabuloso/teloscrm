<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Cria o usuário administrador padrão do sistema.
     */
    public function run(): void
    {
        User::firstOrCreate(
            // Condição de busca
            ['email' => 'admin@teloscrm.com'],

            // Dados do usuário admin
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'tipo' => 'admin',
                'status' => true,
            ]
        );
    }
}
