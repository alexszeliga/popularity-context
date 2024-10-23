<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Resources\User\LoginResource;

Route::middleware('guest')->group(function () {
    Route::post('/register', [UserController::class, 'store'])->name('api.register');
});

Route::middleware('auth.basic')->group(function() {
    Route::get( '/login', fn() => new LoginResource(Auth::user()) );
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [UserController::class, 'show'])->name('user.profile');
});
