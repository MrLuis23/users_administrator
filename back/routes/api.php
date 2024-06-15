<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function(){
    Route::get('/users', 'index');
    Route::get('/user/{id}', 'show');
    Route::put('/user/{id}', 'update');
    Route::delete('/user/{id}', 'destroy');
    Route::post('/user/new', 'store');
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});