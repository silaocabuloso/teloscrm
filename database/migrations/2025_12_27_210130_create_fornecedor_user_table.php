<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela pivot fornecedor_user
     * Responsável por vincular vendedores aos fornecedores.
     */
    public function up(): void
    {
        Schema::create('fornecedor_user', function (Blueprint $table) {

            $table->id();

            // FK para fornecedores
            $table->foreignId('fornecedor_id')
                ->constrained('fornecedores')
                ->cascadeOnDelete();

            // FK para usuários (vendedores)
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Evita vínculo duplicado
            $table->unique(['fornecedor_id', 'user_id']);

            $table->timestamps();
        });
    }

    /**
     * Remove a tabela pivot
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor_user');
    }
};
