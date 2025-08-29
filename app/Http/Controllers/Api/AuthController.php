<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controller for managing authentication
 *
 * @group authentication
 * Apis for managing users
 */
class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @bodyParam name string required The name of the user. Example: "John Doe"
     * @bodyParam email string required The email of the user. Example: "johndoe@example.com"
     * @bodyParam password string required The password of the user. Example: "password123"
     * @bodyParam password_confirmation string required The password confirmation of the user. Example: "password123"
     *
     * @response 201 {
     *   "user": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "email": "johndoe@gmail.com",
     *     "updated_at": "2024-01-01T12:00:00Z",
     *     "created_at": "2024-01-01T12:00:00Z"
     *     },
     *   "token": "1|qwertyuiopasdfghjklzxcvbnm1234567890"
     * }
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {"email": ["The email has already been taken."]}
     * }
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Generate token from sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
