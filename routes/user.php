<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Admin\Http\Controllers\Home\UserHomeController::class, 'index'])->name('home');

Route::get('/information', [App\Admin\Http\Controllers\Home\UserHomeController::class, 'index'])->name('home');

Route::get('/contact', [App\Admin\Http\Controllers\Home\UserHomeController::class, 'index'])->name('home');

Route::get('/products', [App\Admin\Http\Controllers\Home\UserHomeController::class, 'index'])->name('home');

Route::get('/sale-limited', [App\Admin\Http\Controllers\Home\UserHomeController::class, 'index'])->name('home');

Route::get('/auth', [App\Admin\Http\Controllers\Home\UserHomeController::class, 'index'])->name('home');

Route::controller(App\Admin\Http\Controllers\Auth\LoginController::class)
    ->middleware('guest:web')
    ->prefix('/auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::post('/', 'login')->name('post');
});

Route::group(['middleware' => 'admin.auth.admin:web'], function () {
    Route::controller(App\Admin\Http\Controllers\Auth\ProfileController::class)
        ->prefix('/auth')
        ->as('auth.')
        ->group(function () {
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/', 'update')->name('update');
            Route::put('/change-password', 'changePassword')->name('change-password');
        });
});
