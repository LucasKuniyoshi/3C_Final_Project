<?php

namespace App\Domains\AuthDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\AuthDomain\Services\AuthService;
use App\Domains\JobDomain\Models\Job;
use App\Domains\ApplicationDomain\Models\Application;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $validatedData = $this->validateLogin($request);

        $user = $this->authService->login($validatedData['email'], $validatedData['password']);

        if (!$user) {
            return $this->respondInvalidCredentials();
        }

        $token = $this->authService->generateToken($user);

        return $this->respondWithUserData($user, $token);
    }

    protected function validateLogin(Request $request): array
    {
        return $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    protected function respondInvalidCredentials()
    {
        return response()->json([
            'message' => 'Invalid credentials. Please check your email and password and try again.'
        ], 401);
    }

    protected function respondWithUserData($user, $token)
    {
        $responseData = [
            'message' => 'Login successful. Welcome!',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'user_type' => $user->user_type,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
        ];

        if ($user->isCandidate()) {
            $responseData['applications'] = $this->getCandidateApplications($user->id);
        } elseif ($user->isRecruiter()) {
            $responseData['jobs'] = $this->getRecruiterJobs($user->id);
            $responseData['user']['company_id'] = $user->company_id; // Adiciona o company_id
        }

        return response()->json($responseData, 200);
    }

    protected function getCandidateApplications(int $userId)
    {
        return Application::with('job')
            ->where('user_id', $userId)
            ->get();
    }

    protected function getRecruiterJobs(int $recruiterId)
    {
        return Job::where('recruiter_id', $recruiterId)->get();
    }
}
