<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PedidoApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Login da API
    Route::post('/autenticacao', [AuthController::class, 'login']);

    // Rotas protegidas por token
    Route::middleware('auth:sanctum')->group(function () {

        Route::get(
            '/fornecedor/{cnpj}/pedidos',
            [PedidoApiController::class, 'pedidosPorFornecedor']
        );

        Route::get(
            '/pedidos/{pedido}',
            [PedidoApiController::class, 'show']
        );

        Route::post(
            '/pedidos',
            [PedidoApiController::class, 'store']
        );

        Route::put(
            '/pedidos/{pedido}',
            [PedidoApiController::class, 'update']
        );

        Route::delete(
            '/pedidos/{pedido}',
            [PedidoApiController::class, 'destroy']
        );
    });
});
