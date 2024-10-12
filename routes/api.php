<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/login', function(){
    return response()->json([
        'data' => 
            ['token' => Auth::user()->createToken('api-login')->plainTextToken],
    ]);
})->middleware('auth.basic');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
