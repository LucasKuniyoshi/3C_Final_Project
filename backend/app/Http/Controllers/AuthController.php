<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Verifica as credenciais e autentica o usuário
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Checa o tipo do usuário e redireciona para a página correspondente
            if ($user->user_type === 'recruiter') {
                return redirect()->route('recruiter.dashboard'); // Dashboard de Recrutador
            } elseif ($user->user_type === 'candidate') {
                return redirect()->route('candidate.jobs'); // Página de visualização de vagas para Candidato
            }

            return redirect()->route('home'); // Rota padrão
        } else {
            // Retorna um erro de autenticação caso as credenciais estejam incorretas
            return back()->withErrors([
                'email' => 'Credenciais inválidas. Tente novamente.',
            ]);
        }
    }
}
