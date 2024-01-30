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

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/emotions', [EmotionController::class, 'index']);
});

Route::middleware('auth:sanctum')->resource('users', UserController::class);