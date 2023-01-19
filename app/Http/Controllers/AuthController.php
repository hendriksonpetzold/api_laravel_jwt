<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $input = $request->validated();

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
        ];

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }



        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' =>  auth('api')->factory()->getTTL() * 60,
            'expires_in' =>  3600,
        ]);
    }
}
