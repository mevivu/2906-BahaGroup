<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\Home\UserHomeController::class)
    ->prefix('/')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/information', 'information')->name('information');
        Route::get('/contact', 'contact')->name('contact');
    });

Route::controller(App\Http\Controllers\Product\ProductController::class)
    ->prefix('/products')
    ->as('product.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::get('/sale-limited', 'saleLimited')->name('saleLimited');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/render-modal/{id?}', 'renderModalProduct')->name('render');
        Route::get('/detailModal/{id}', 'detailModal')->name('detailModal');
        Route::get('/find-variation-by-attribute-ids', 'findVariationByAttributeVariationIds')->name('findVariationByAttributeVariationIds');
        Route::get('/search', 'searchProduct')->name('search');
    });

Route::controller(App\Http\Controllers\ShoppingCart\ShoppingCartController::class)
    ->prefix('/cart')
    ->as('cart.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/', 'update')->name('update');
        Route::post('/apply', 'applyDiscountCode')->name('applyCode');
        Route::post('/increament', 'increament')->name('increament');
        Route::post('/decreament', 'decreament')->name('decreament');
        Route::delete('/remove/{id?}', 'delete')->name('remove');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/checkout-final', 'checkoutFinal')->name('checkoutFinal');
    });

Route::controller(App\Http\Controllers\Auth\LoginController::class)
    ->middleware('guest:web')
    ->prefix('/auth')
    ->as('auth.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
        Route::post('/forgot-password', 'forgotPasswordSend')->name('forgotPasswordSend');
        Route::get('/reset-password', 'resetPassword')->name('resetPassword');
        Route::put('/reset-password', 'changePassword')->name('changePassword');
        Route::post('/', 'loginUser')->name('loginUser');
        Route::post('/register', 'signinUser')->name('register');
        Route::get('/oauth-verification', 'oauth')->name('oauth');
        Route::post('/oauth-verification', 'oauthChange')->name('oauthChange');
    });

Route::controller(App\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('password.reset.')
    ->group(function () {
        Route::post('/edit', 'edit')->name('edit');
        Route::get('/verify', 'verify')->name('verify');
        Route::put('/update', 'update')->name('update');
    });

Route::controller(App\Http\Controllers\Order\OrderController::class)
    ->prefix('/orders')
    ->as('order.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/cancel/{id?}', 'cancel')->name('cancel');
        Route::get('/review/{id?}', 'review')->name('review');
        Route::get('/review/{id}/detail', 'review_detail')->name('review_detail');
    });

Route::controller(App\Admin\Http\Controllers\Auth\ChangePasswordController::class)
    ->prefix('/password')
    ->as('password.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::put('/', 'update')->name('update');
    });

Route::group(['middleware' => 'admin.auth.user:web'], function () {
    Route::controller(App\Admin\Http\Controllers\Auth\ProfileController::class)
        ->prefix('/profile')
        ->as('profile.')
        ->group(function () {
            Route::get('/', 'indexUser')->name('indexUser');
            Route::put('/', 'update')->name('update');
        });
    Route::post('/logout', [App\Admin\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
});

Route::controller(App\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('password.reset.')
    ->group(function () {
        Route::get('/edit', 'edit')->name('edit')->middleware('signed');
        Route::put('/update', 'update')->name('update');
        Route::get('/success', 'success')->name('success');
    });
Route::controller(App\Http\Controllers\Post\PostController::class)
    ->prefix('/posts')
    ->as('post.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{idPost}-{slugPost}', 'detail')->name('detail');
        Route::get('/category/{idCategory}-{slugCategory}', 'category')->name('category');
    });
