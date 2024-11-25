<?php

namespace App\Domains\AuthDomain\Services;

use App\Domains\AuthDomain\Repositories\AuthRepository;
use App\Domains\ApplicationDomain\Models\Application;
use App\Domains\JobDomain\Models\Job;
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

    public function getAdditionalDataForUser($user)
    {
        if ($user->user_type === 'candidate') {
            return [
                'applications' => Application::with('job')
                    ->where('user_id', $user->id)
                    ->get(),
            ];
        }

        if ($user->user_type === 'recruiter') {
            return [
                'jobs' => Job::where('recruiter_id', $user->id)->get(),
            ];
        }

        return [];
    }
}
