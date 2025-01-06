<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\AuthController;
// use App\Http\Controllers\API\UserController;
// use App\Http\Controllers\API\ProfileController;

// // Routes d'authentification
// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('logout', [AuthController::class, 'logout']);
    
//     // Routes pour les utilisateurs
//     Route::apiResource('users', UserController::class);
//     Route::post('users/{user}/assign-profile', [UserController::class, 'assignProfile']);

//     // Routes pour les profils
//     Route::apiResource('profiles', ProfileController::class);
// });