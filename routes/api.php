<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', [UserController::class, 'me'])->name('me');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/refresh-tokens', [UserController::class, 'refreshTokens'])->name('refresh-tokens');
});
