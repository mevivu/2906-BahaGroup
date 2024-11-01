<?php

use Illuminate\Support\Facades\Route;

//lookup
Route::controller(App\Api\V1\Http\Controllers\Lookup\LookupController::class)
    ->prefix('/lookup')
    ->group(function () {
        Route::get('/payment-type', 'paymentType')->name('paymentType');
        Route::get('/payment-status', 'paymentStatus')->name('paymentStatus');
        Route::get('/payment-method', 'paymentMethod')->name('paymentMethod');
        Route::get('/order-status', 'orderStatus')->name('orderStatus');
        Route::get('/gender', 'gender')->name('gender');
    });

//notification
Route::controller(App\Api\V1\Http\Controllers\Notification\NotificationController::class)
    ->middleware('auth:sanctum')
    ->prefix('/notifications')
    ->group(function () {
        Route::get('/show/{id}', 'detail')->name('detail');
        Route::get('/', 'getUserNotifications')->name('getUserNotifications');
        Route::get('/read-all', 'updateAllStatusRead')->name('updateAllStatusRead');
    });

//post category
Route::controller(App\Api\V1\Http\Controllers\PostCategory\PostCategoryController::class)
    ->prefix('/posts-categories')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });

//posts
Route::controller(App\Api\V1\Http\Controllers\Post\PostController::class)
    ->prefix('/posts')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/featured', 'featured')->name('featured');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/related/{id}', 'related')->name('related');
    });

Route::middleware('auth:sanctum')->group(function () {
    //order
    Route::controller(App\Api\V1\Http\Controllers\Order\OrderController::class)
        ->prefix('/orders')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/cancel/{id}', 'cancel')->name('cancel');
            Route::get('/show/{id}', 'show')->name('show');
        });
    //shopping cart
    Route::controller(App\Api\V1\Http\Controllers\ShoppingCart\ShoppingCartController::class)
        ->prefix('/shopping-cart')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
});

Route::prefix('/categories')
    ->group(function () {
        Route::controller(App\Api\V1\Http\Controllers\Category\CategoryController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/home', 'home')->name('home');
                Route::get('/product', 'product')->name('product');
                Route::get('/show/{id}', 'show')->name('show');
            });
    });

Route::prefix('/products')
    ->group(function () {
        Route::controller(App\Api\V1\Http\Controllers\Product\ProductController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/search', 'search')->name('search');
            });
        Route::controller(App\Api\V1\Http\Controllers\Product\ProductVariationController::class)
            ->prefix('/variation')
            ->group(function () {
                Route::get('/show', 'show')->name('show');
            });
    });

//slider
Route::controller(App\Api\V1\Http\Controllers\Slider\SliderController::class)
    ->prefix('/sliders')
    ->group(function () {
        Route::get('/show/{key}', 'show')->name('show');
    });

//auth
Route::controller(App\Api\V1\Http\Controllers\Auth\AuthController::class)
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/auth')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/logout', 'logout')->name('logout');
            Route::post('/update', 'update')->name('update');
            Route::post('/update-password', 'updatePassword')->name('updatePassword');
        });
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/delete', 'delete')->name('delete');
    });

Route::controller(App\Api\V1\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->group(function () {
        Route::post('/', 'checkAndSendMail')->name('checkAndSendMail');
    });

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'message' => __('Không tìm thấy đường dẫn.')
    ], 404);
});
