<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ApplicationController;


Route::apiResource('users', UserController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('jobs', JobController::class);
Route::apiResource('applications', ApplicationController::class);

//Routes of user
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, "store"]);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});

//Routes of job
Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index']);
    Route::post('/', [JobController::class, 'store']);
    Route::get('/{id}', [JobController::class, 'show']);
    Route::put('/{id}', [JobController::class, 'update']);
    Route::delete('/s{id}', [JobController::class, 'delete']);
});

//Routes of company
Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);           // Listar todas as empresas
    Route::post('/', [CompanyController::class, 'store']);          // Criar uma nova empresa
    Route::get('/{id}', [CompanyController::class, 'show']);        // Exibir detalhes de uma empresa específica
    Route::put('/{id}', [CompanyController::class, 'update']);      // Atualizar uma empresa existente
    Route::delete('/{id}', [CompanyController::class, 'destroy']);  // Excluir uma empresa
});

//Routes of application
Route::prefix('applications')->group(function () {
    Route::get('/', [ApplicationController::class, 'index']);
    Route::post('/', [ApplicationController::class, 'store']);
    Route::get('/{id}', [ApplicationController::class, 'show']);
    Route::put('/{id}', [ApplicationController::class, 'update']);
    Route::delete('/{id}', [ApplicationController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
