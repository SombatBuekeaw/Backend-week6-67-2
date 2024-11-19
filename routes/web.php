<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;

Route::get('/', function () {
    return view('welcome');
})->name('home.index');

Route::prefix('account')->group(function () {

    //Gust middleware
    Route::middleware(['guest'])->group(function () {
        Route::get('account/login', [UserController::class, 'index'])->name('account.login');
        Route::post('account/login', [UserController::class, 'login'])->name('account.login');

        Route::get('account/register', [UserController::class, 'register'])->name('account.register');
        Route::post('account/processRegister', [UserController::class, 'processRegister'])->name('account.processRegister');
    });
});

Route::middleware(['auth'])->group(function () {

    Route::get('account/dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
    Route::get('account/logout', [UserController::class, 'logout'])->name('account.logout');
});

Route::prefix('admin')->group(function(){
    route::middleware(['admin.guest'])->group(function(){

        Route::get('login}', [AdminController::class, 'index'])->name('admin.login');
        Route::post('login}', [AdminController::class, 'login'])->name('admin.login');

    });
    Route::middleware(['admin.auth'])->group(function(){
        Route::get('dashboard}', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    });

});



