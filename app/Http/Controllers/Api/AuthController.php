<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Autenticação da API
     * Recebe email e senha e retorna um token
     */
    public function login(Request $request)
    {
        // Validação básica
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenta autenticar usando o mesmo sistema do login web
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciais inválidas',
            ], 401);
        }

        // Usuário autenticado
        $user = Auth::user();

        // Gera token de acesso
        $token = $user->createToken('api-token')->plainTextToken;

        // Retorna token + dados do usuário
        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
}
