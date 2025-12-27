<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuarioAtivoMiddleware
{
    /**
     * impede acesso de usuarios inativos
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user && !$user->isAtivo()) {
            abort(403, 'Usuario inativo');
        }

        return $next($request);
    }
}
