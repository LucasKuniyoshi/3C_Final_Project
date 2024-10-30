<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\JobController;
use app\Http\Controllers\CompanyController;
use app\Http\Controllers\UserController;

//Routes of user
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'delete']);

//Routes of job
Route::get('/job', [JobController::class, 'index']);
Route::post('/job', [JobController::class, 'store']);
Route::get('/job/{id}', [JobController::class, 'show']);
Route::put('/job/{id}', [JobController::class, 'update']);
Route::delete('/job/{id}', [JobController::class, 'delete']);

//Routes of company
Route::get('/company', [CompanyController::class, 'index']);
Route::post('/company', [CompanyController::class, 'store']);
Route::get('/company/{id}', [CompanyController::class, 'show']);
Route::put('/company/{id}', [CompanyController::class, 'update']);
Route::delete('/company/{id}', [CompanyController::class, 'delete']);

//Routes of application
Route::get('/application', [ApplicationController::class, 'index']);
Route::post('/application', [ApplicationController::class, 'store']);
Route::get('/application/{id}', [ApplicationController::class, 'show']);
Route::put('/application/{id}', [ApplicationController::class, 'update']);
Route::delete('/application/{id}', [ApplicationController::class, 'delete']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
