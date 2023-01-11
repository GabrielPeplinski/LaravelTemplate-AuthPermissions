<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|exists:users,email',
            'password' => 'required|string'
        ]);

        if (!auth()->attempt($credentials))
            abort(401, 'Invalid credentials');

        $token = auth()->user()->createToken('auth_token');

        return response()
            ->json([
                'data' => [
                    'message' => 'User sucefully logged',
                    'token' => $token->plainTextToken,
                    'name' => auth()->user()->name,
                    'status' => 201
                ]
            ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();

        return response()
            ->json([
                'data' => [
                    'message' => 'User sucefully logged out',
                    'name' => auth()->user()->name,
                    'status' => 200
                ]
            ]);
    }
}
