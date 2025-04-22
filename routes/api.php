<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('history')->group(function () {
    Route::get('/', [TranslationController::class, 'index']);
    Route::post('/save', [TranslationController::class, 'store']);
    Route::get('/{id}', [TranslationController::class, 'show']);
    Route::delete('/{id}', [TranslationController::class, 'destroy']);
    Route::get('/user/{user_id}', [TranslationController::class, 'userHistory']);
});

Route::prefix('auth')->group(function (){
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::get('/me', [UserController::class, 'profile'])
    ->middleware('auth:sanctum');
});

Route::post('/upload', [VideoController::class, 'uploadMedia']);
