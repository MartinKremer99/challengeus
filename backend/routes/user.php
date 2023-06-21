<?php


use App\Http\Controllers\User\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->group(function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->post('logout', [LogoutController::class, 'logout'])->name('logout');
});
