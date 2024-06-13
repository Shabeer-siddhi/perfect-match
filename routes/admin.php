<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardCotroller;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->group(function () {
    Route::group(['middleware' => ['auth', 'admin']], function () {

        Route::get('/dashboard', [DashboardCotroller::class, 'dashboard'])->name('dashboard');

        Route::resource('customer', CustomerController::class);
    });
});
