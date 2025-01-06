<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    // User Registration
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to register user', $e);
        }
    }

    // User Login
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation errors',
                    'errors' => $validateUser->errors(),
                ], 422);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password do not match our records.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('API TOKEN', ['*'], now()->addMinutes(30))->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'token' => $token,
                'expires_at' => now()->addMinutes(30),
                'role' => $user->role // Ensure the User model has a `role` relationship
            
            ], 200);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to login user', $e);
        }
    }

    // User Logout
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Déconnexion réussie'
            ], 200);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to logout user', $e);
        }
    }

    // Helper Method: Validation Error Response
    private function validationErrorResponse($e)
    {
        return response()->json([
            'status' => false,
            'message' => 'Validation Error',
            'errors' => $e->errors()
        ], 422);
    }

    // Helper Method: Generic Error Response
    private function errorResponse($message, $e)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $e->getMessage()
        ], 500);
    }
}
