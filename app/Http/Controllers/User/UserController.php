<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $users,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = [
            'name' => 'required|max:255|min:3',
            'username' => 'required|max:255|min:3|unique:users,username',
            'alamat' => 'required|min:3',
            'image' => 'nullable|max:255',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ];
        $validator = Validator::make($request->all(), $validated);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
                'data' => $request->all(),
            ], 400);
        } else {
            $createUser = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'alamat' => $request->alamat,
                'image' => $request->image,
                'password' => $request->password,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'created',
                'data' => $createUser,
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        if (!empty($user)) {
            return response()->json($user);
        } else {
            return response()->json([
                'success' => false,
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->exists()) {
            $validated = [
                'name' => 'required|max:255|min:3',
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                // 'email' => [
                //     'requrired',
                //     Rule::unique('users')->ignore($user->id),
                // ],
                'alamat' => 'required|min:3',
                'image' => 'nullable|max:255',
                'password' => 'nullable|confirmed|min:8',
                'password_confirmation' => 'nullable',
            ];
            $validator = Validator::make($request->all(), $validated);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                    'data' => $request->all(),
                ], 400);
            } else {
                $user->update([
                    'name' => $request->name,
                    'username' => $request->username,
                    'alamat' => $request->alamat,
                    'image' => $request->image,
                    'password' => $request->password,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'updated',
                    'data' => $user,
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->exists()) {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'deleted',
                'data' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Doesn't have a data",
            ], 400);
        }
    }
}
