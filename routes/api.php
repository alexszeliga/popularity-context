<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User\LoginResource;

Route::middleware('auth.basic')->group(function(){
    Route::get('/login', function() { return new LoginResource(Auth::user()); });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
