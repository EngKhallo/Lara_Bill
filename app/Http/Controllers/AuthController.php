<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // validating inputs
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        // for creating a user with hashed password
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        // creating a token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        // Revoke the user's tokens
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return [
            'message' => 'Logged out',
        ];
    }

    public function loggedInUser()
    {
        $user = Auth::user();

        return $user;
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); // returns an array of validated email and password 

        $credentials = $request->only('email', 'password');

        // Auth::attempt ->checks if user is in the database and log in the user and create new session

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $fields['email'])->first();
            $token = $user->createToken('myapptoken')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
