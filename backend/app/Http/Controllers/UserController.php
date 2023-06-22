<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
                'data' => null
            ], 400);
        }

        $user = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($user) {
            $authUser = Auth::user();
            $token = $authUser->createToken('ChallengeUsLogin')->plainTextToken;

            // @TODO: when going live
            // $request->session()->regenerate();

            return response()->json([
                'status' => 'success',
                'message' => 'User logged in',
                'data' => [
                    'token' => $token,
                    'user' => $authUser,
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Wrong credentials',
            'data' => null
        ], 400);

    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged out',
            'data' => ''
        ]);
    }


}
