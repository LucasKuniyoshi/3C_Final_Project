<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ApplicationController;
use App\Domains\UserDomain\Controllers\UserController;


Route::apiResource('users', UserController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('jobs', JobController::class);
Route::apiResource('applications', ApplicationController::class);
Route::apiResource('auths', AuthController::class);

//Routes of User
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

//Routes of Job
Route::middleware(['role:recruiter', 'auth:sanctum'])->group(function () {
    Route::post('/jobs', [JobController::class, 'store']);
    Route::put('/jobs/{id}', [JobController::class, 'update']);
    Route::delete('/jobs/{id}', [JobController::class, 'destroy']);
});

Route::middleware(['role:candidate'])->group(function () {
    Route::post('/jobs/{id}/apply', [JobController::class, 'apply']);
});

//Routes of Company
Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);           // Listar todas as empresas
    Route::post('/', [CompanyController::class, 'store']);          // Criar uma nova empresa
    Route::get('/{id}', [CompanyController::class, 'show']);        // Exibir detalhes de uma empresa específica
    Route::put('/{id}', [CompanyController::class, 'update']);      // Atualizar uma empresa existente
    Route::delete('/{id}', [CompanyController::class, 'destroy']);  // Excluir uma empresa
});

//Routes of Application
Route::prefix('applications')->group(function () {
    Route::get('/', [ApplicationController::class, 'index']);
    Route::post('/', [ApplicationController::class, 'store']);
    Route::get('/{id}', [ApplicationController::class, 'show']);
    Route::put('/{id}', [ApplicationController::class, 'update']);
    Route::delete('/{id}', [ApplicationController::class, 'delete']);
});

//Routes of Login
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Rotas protegidas específicas para cada tipo de usuário
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/recruiter/dashboard', [AuthController::class, 'recruiterDashboard'])->name('recruiter.dashboard');
    Route::get('/candidate/jobs', [AuthController::class, 'candidateJobs'])->name('candidate.jobs');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
