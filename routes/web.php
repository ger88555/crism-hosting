<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(config('app.url'))->name('frontoffice.')->group(function() {
    Route::view('/', 'frontoffice.home.index')->name('home');
    Route::view('/about', 'frontoffice.about.index')->name('about');
    Route::view('/blank', 'frontoffice.blank.index')->name('blank');
    Route::view('/pricing', 'frontoffice.pricing.index')->name('pricing');
    Route::view('/ftp', 'frontoffice.ftp.index')->name('ftp');
});