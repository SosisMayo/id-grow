<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        $user = User::where('email', $request->email)->first();
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
            ],201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'data' => Auth::user(),
            'token' => $token,
        ],200);
    }

    public function refresh()
    {
        try {
            // Refresh the token
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'data' => Auth::user(),
                'token' => $newToken,
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Token could not be refreshed'
            ], 401);
        }
    }

    public function logout()
    {
        try {
            // Invalidate the current token
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Successfully logged out'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Failed to invalidate token'
            ], 500);
        }
    }
}
