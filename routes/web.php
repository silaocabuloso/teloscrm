<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FornecedorController;
    use App\Http\Controllers\FornecedorVinculoController;
    use App\Http\Controllers\ProdutoController;
    use App\Http\Controllers\ProdutoUploadController;

/*

 *Rotas públicas

*/
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
*Rotas protegidas (usuário autenticado e ativo)

*/
Route::middleware(['auth', 'usuario.ativo'])->group(function () {

    Route::get('/produtos/upload', [ProdutoUploadController::class, 'create'])
    ->name('produtos.upload.create');

Route::post('/produtos/upload', [ProdutoUploadController::class, 'store'])
    ->name('produtos.upload');

    Route::resource('produtos', ProdutoController::class)
    ->only(['index', 'create', 'store']);

    Route::resource('fornecedores', FornecedorController::class);

        Route::patch(
        'fornecedores/{fornecedor}/status',
        [FornecedorController::class, 'toggleStatus']
    )->name('fornecedores.status');

    /**
     * Dashboard principal do sistema
     */
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    /**
     * Rotas de perfil do usuário
     */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
   *Rotas exclusivas de administrador
  
    */
    Route::middleware('admin')->group(function () {



Route::get('/vinculos', [FornecedorVinculoController::class, 'index'])
    ->name('vinculos.index');

Route::post('/vinculos', [FornecedorVinculoController::class, 'store'])
    ->name('vinculos.store');


    });

});

require __DIR__.'/auth.php';
