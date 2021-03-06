<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Auth')->group(function () {

    Route::namespace('Customer')->group(function () {

        Route::get('/registro', 'RegisteredCustomerController@create')
            ->middleware('guest')
            ->name('register');
    
        Route::post('/registro', 'RegisteredCustomerController@store')
            ->middleware('guest');
    
        Route::get('/login', 'AuthenticatedSessionController@create')
            ->middleware('guest')
            ->name('login');
    
        Route::post('/login', 'AuthenticatedSessionController@store')
            ->middleware('guest');

        Route::post('/logout', 'AuthenticatedSessionController@destroy')
            ->middleware('auth')
            ->name('logout');
    });

    Route::namespace('Admin')->group(function () {

        Route::get('/log-in', 'AdminAuthenticatedSessionController@create')
            ->middleware('guest')
            ->name('log-in');
    
        Route::post('/log-in', 'AdminAuthenticatedSessionController@store')
            ->middleware('guest');
    }); 
});