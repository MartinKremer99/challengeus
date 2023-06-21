<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;



class LogoutController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json();
    }
}
