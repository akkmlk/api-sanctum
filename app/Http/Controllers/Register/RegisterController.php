<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = [
            'name' => 'required|max:255|min:3',
            'username' => 'required|max:255|min:3',
            'alamat' => 'required|min:3',
            'password' => 'required|min:8|confirmed',
        ];

        $validator = Validator::make($request->all(), $validated);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $request->all(),
            ], 401);
        } else {
            $register = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'alamat' => $request->alamat,
                'password' => $request->password,
            ]);
    
            if ($register) {
                return response()->json([
                    'success' => true,
                    'message' => 'registered',
                    'data' => $register,
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'failed registered',
                    'data' => $request->all(),
                ], 401);
            }
        }
    }
}
