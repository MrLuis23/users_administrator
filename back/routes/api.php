<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;


Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
});

Route::controller(UserController::class)->group(function(){
    Route::post('/user/new', 'store');
});

Route::middleware('auth:api')->group(function () {
    Route::controller(UserController::class)->group(function(){
        Route::get('/user/{id}', 'show');
        Route::put('/user/{id}', 'update');
        Route::delete('/user/{id}', 'destroy');
        Route::get('/users', 'index');
    });
    Route::controller(AuthController::class)->group(function(){
        Route::post('/logout', 'logout');
    });
});

