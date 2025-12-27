<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UsuarioAtivoMiddleware
{
    /**
     * Garante que apenas usuários ativos acessem o sistema.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Se não estiver autenticado, deixa o auth cuidar disso
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$user->status) {
            abort(403, 'Usuário inativo.');
        }

        return $next($request);
    }
}
