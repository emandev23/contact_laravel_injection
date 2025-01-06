<?php

use App\Http\Controllers\Api\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;          
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\ChauffeurController;
use App\Http\Controllers\Api\VehiculeController;
use App\Http\Controllers\Api\TarificationController;
use App\Http\Controllers\Api\FactureController;
use App\Http\Controllers\Api\CarburantController;
use App\Http\Controllers\Api\VoyageController;


// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected routes with sanctum authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Role-specific routes for admins
    Route::middleware('role:admin')->group(function () {

        // User management routes
        Route::apiResource('users', UserController::class);

        // Role management routes
        Route::get('roles', [RoleController::class, 'index']);
        Route::post('roles', [RoleController::class, 'store']);
        Route::get('roles/{role}', [RoleController::class, 'show']);
        Route::put('roles/{role}', [RoleController::class, 'update']);
        Route::delete('roles/{role}', [RoleController::class, 'destroy']);
        Route::post('roles/{role}/assign-permissions', [RoleController::class, 'assignPermissions']);

        // Chauffeur management
        Route::apiResource('chauffeurs', ChauffeurController::class);

        // Vehicule management
        Route::apiResource('vehicules', VehiculeController::class);

        // Tarification management
        Route::apiResource('tarifications', TarificationController::class);

        // Facture management
        Route::apiResource('factures', FactureController::class);

        // Carburant management
        Route::apiResource('carburants', CarburantController::class);

        // Voyage management
        Route::apiResource('voyages', VoyageController::class);

        Route::apiResource('clients', ClientController::class);
    });
});
