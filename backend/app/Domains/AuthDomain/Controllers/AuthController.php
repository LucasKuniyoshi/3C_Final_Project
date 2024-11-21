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


        return response()->json([
            'message' => 'Login successful. Welcome!',
            'token' => $token
        ]);
    }
}
