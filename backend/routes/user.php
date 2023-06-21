<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->group(function () {
    Route::post('login', [UserController::class, 'login'])->name('login');
});
