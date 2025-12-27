<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * permite acesso apenas do admin
     */
    public function handle(Request $request, Closure $next): Response
    {

         $user =auth()->user();

         if (!$user || !user->isAdmin()) {
            abort(403, 'Acesso permitido apenas para adms.');
         }


        return $next($request);
    }
}
