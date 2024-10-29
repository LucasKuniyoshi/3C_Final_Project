<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\JobController;
use app\Http\Controllers\CompanyController;
use app\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('jobs', JobController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
