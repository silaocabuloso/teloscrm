<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//altera a tabela users
return new class extends Migration
{
    /**
     * aqui adcionamos colunas ao banco
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // definir tipo do usuario: admim, vendedor
            $table->string('tipo')
            ->default('vendedor')
            ->after('password');

            //definir se o usuario está ativo
            $table->boolean('status')
            ->default(true)
            ->after('tipo');
        });
    }

    /**
     * usar se precisar remover colunas.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'status']);
            //
        });
    }
};
