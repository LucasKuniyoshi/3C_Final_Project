<?php
namespace App\Domains\AuthDomain\Services;

use App\Domains\AuthDomain\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }


    public function login($email, $password)
    {
        $user = $this->authRepository->findByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }


    public function generateToken($user)
    {
        return $user->createToken('YourAppName')->plainTextToken;
    }
}
