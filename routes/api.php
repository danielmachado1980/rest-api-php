<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckProfile;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::get('/users', 'App\Http\Controllers\UserController@index');
    Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');

    Route::middleware(CheckProfile::class)->group(function () {
        Route::post('/users', 'App\Http\Controllers\UserController@store');
        Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
        Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');
    });
});
