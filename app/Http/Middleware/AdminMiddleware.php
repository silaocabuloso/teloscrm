<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Permite acesso apenas para usuários administradores.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Se não estiver logado ou não for admin, bloqueia
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Acesso permitido apenas para administradores.');
        }

        return $next($request);
    }
}
