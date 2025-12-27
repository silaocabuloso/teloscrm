<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de produtos
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            // Produto pertence a um fornecedor
            $table->foreignId('fornecedor_id')
                ->constrained('fornecedores')
                ->cascadeOnDelete();

            $table->string('referencia');
            $table->string('nome');
            $table->string('cor')->nullable();
            $table->decimal('preco', 10, 2);

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
