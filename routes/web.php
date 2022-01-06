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

use App\Http\Controllers\SelectedPlanController;
use App\Http\Controllers\ShowCustomerDashboardController;
use App\Http\Controllers\ShowAdminDashboardController;

Route::name('frontoffice.')->group(function() {
    Route::view('/', 'frontoffice.home.index')->name('home');
    Route::view('/about', 'frontoffice.about.index')->name('about');
    Route::view('/blank', 'frontoffice.blank.index')->name('blank');
    Route::view('/pricing', 'frontoffice.pricing.index')->name('pricing');
    Route::view('/ftp', 'frontoffice.ftp.index')->name('ftp');
});

Route::name('customer.')->middleware('auth:customer')->group( function () {

    Route::middleware('plan:true')->group(function () {
        Route::get('/dashboard', ShowCustomerDashboardController::class)->name('dashboard');
    });

    Route::middleware('plan:false')->group(function () {    
        
        Route::name('plans.')->prefix('/plans')->group(function () {
            Route::get('/', [SelectedPlanController::class, 'create'])->name('create');
            Route::post('/{plan}', [SelectedPlanController::class, 'store'])->name('store');
        });
    });
});

Route::name('admin.')->middleware('auth:admin')->group( function () {

    Route::get('/administracion', ShowAdminDashboardController::class)->name('dashboard');
});

require __DIR__.'/auth.php';
