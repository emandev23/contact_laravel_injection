<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => true,
                'message' => 'Users retrieved successfully',
                'data' => $users
            ], 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve users', $e);
        }
    }

    // Store a new user
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role_id' => 'required|integer|exists:roles,id',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => $validated['role_id'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create user', $e);
        }
    }

    // Show a specific user
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'status' => true,
                'message' => 'User retrieved successfully',
                'data' => $user
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse('User not found');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve user', $e);
        }
    }

    // Update a specific user
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $user->id,
                'password' => 'sometimes|min:6',
                'role_id' => 'sometimes|integer|exists:roles,id',
            ]);

            $user->update(array_merge(
                $validated,
                ['password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password]
            ));

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'data' => $user
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->validationErrorResponse($e);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse('User not found');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update user', $e);
        }
    }

    // Delete a user
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFoundResponse('User not found');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete user', $e);
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

    // Helper Method: Not Found Error Response
    private function notFoundResponse($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], 404);
    }

    // Helper Method: General Error Response
    private function errorResponse($message, $e)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $e->getMessage()
        ], 500);
    }
}
