<?php
namespace App\Domains\AuthDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AuthDomain\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->authService->login($request->email, $request->password);

        if (!$user) {
            return response()->json([
                'message' => 'Invalid credentials. Please check your email and password and try again.'
            ], 401);
        }

        $token = $this->authService->generateToken($user);

        // Retorna os dados do usuário junto com o token
        return response()->json([
            'message' => 'Login successful. Welcome!',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'user_type' => $user->user_type,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                // Inclua mais campos, se necessário
            ],
        ]);
    }
}
