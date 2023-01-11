<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request, User $user): JsonResponse
    {
        $userData = $request->validate([
            'email' => 'required|string',
            'name' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $userData['password'] = bcrypt($userData['password']);

        if (!$user = $user->create($userData))
            abort(500, 'Error to create a new user');

        return response()
            ->json([
                'data' => [
                    'message' => 'User sucefully registered',
                    'name' => $user->name,
                    'status' => 201
                ]
            ]);
    }
}
