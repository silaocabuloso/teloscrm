<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *Cria a tabela de fornecedores
     */
    public function up(): void
    {
        Schema::create('fornecedores', function (Blueprint $table) {
                $table->id();

            // Nome do fornecedor
            $table->string('nome');

            // CNPJ (somente números, validado na aplicação)
            $table->string('cnpj')->unique();

            // CEP para buscar endereço via ViaCEP
            $table->string('cep');

            // Endereço completo
            $table->string('endereco');

            // Status do fornecedor (ativo ou inativo)
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedores');
    }
};
