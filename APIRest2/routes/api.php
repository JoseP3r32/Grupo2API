<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\EmotionController;
use App\Http\Controllers\API\UserController;


Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:api')->group(function () {
    Route::get('/emotions', [EmotionController::class, 'index']);
    Route::post('/emotions', [EmotionController::class, 'store']);
    Route::get('/emotions/{emotion}', [EmotionController::class, 'show']);
    Route::put('/emotions/{emotion}', [EmotionController::class, 'update']);
    Route::patch('/emotions/{emotion}', [EmotionController::class, 'update']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
});

Route::middleware('auth:api')->delete('/emotions/{emotion}', [EmotionController::class, 'destroy']);

