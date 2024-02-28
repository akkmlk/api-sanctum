<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = [
            'username' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $validated);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $credentials = $request->only(['username', 'password']);
            if (Auth::attempt($credentials)) {
                $user = User::query()->where('username', $request->username)->latest()->first();
                return response()->json([
                    'success' => true,
                    'message' => 'login',
                    'token' => $user->createToken('crud_api')->plainTextToken
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'credentials tidak ditemukan',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'logouted',
        ]);
    }
}
