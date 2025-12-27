<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Rotas públicas
|--------------------------------------------------------------------------
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

        // Intencionalmente vazio neste momento
        // Será utilizado nas próximas fases (ex: fornecedores, usuários)

    });

});

require __DIR__.'/auth.php';
