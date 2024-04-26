<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => 'required',
            'phone' => 'string',
            // 'roles' => 'alpha'
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['roles'] = 'USER';

        $user = User::create($validated);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login = User::where('email', $validated['email'])->first();

        if(!$login) {
            return response()->json([
                'message' => 'Email not found',
            ], 401);
        }

        if(!Hash::check($validated['password'], $login['password'])) {
            return response()->json([
                'message' => 'Invalid password',
            ], 401);
        }

        $token = $login->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $login,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success',
        ], 200);
    }

    public function updateFcmId(Request $request) {
        $validated = $request->validate([
            'fcm_id' => 'required'
        ]);

        if(!$validated) {
            return response()->json([
                'message' => 'FCM ID required!',
            ], 400);
        }

        $user = $request->user();
        $user->fcm_id = $validated['fcm_id'];
        $user->save();

        return response()->json([
            'message' => 'FCM ID updated.',
        ], 200);
    }


}
