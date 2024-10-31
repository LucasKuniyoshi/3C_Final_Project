<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserTypeMiddleware
{
    public function handle($request, Closure $next, $user_type)
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login'); // Redireciona para o login se não estiver autenticado
        }

        // Verifica se o user_type do usuário corresponde ao user_type necessário para a rota
        $user = Auth::user();
        if ($user->user_type !== $user_type) {
            // Redireciona para a página correspondente ao user_type do usuário
            return $user_type === 'recruiter'
                ? redirect()->route('candidate.jobs')
                : redirect()->route('recruiter.dashboard');
        }

        return $next($request);
    }
}
