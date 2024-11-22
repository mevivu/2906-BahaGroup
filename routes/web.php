<?php

use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\Home\UserHomeController::class)
    ->prefix('/')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/gioi-thieu', 'information')->name('information');
        Route::get('/lien-he', 'contact')->name('contact');
        Route::get('/tra-cuu/{code}', 'getOrderDetailForCustomer')->name('getOrderDetailForCustomer');
    });

Route::controller(App\Http\Controllers\Home\UserHomeController::class)
    ->prefix('/vnpay-payment')
    ->as('payment.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/gioi-thieu', 'information')->name('information');
        Route::get('/lien-he', 'contact')->name('contact');
    });

Route::controller(App\Http\Controllers\Product\ProductController::class)
    ->prefix('/san-pham')
    ->as('product.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::get('/khuyen-mai-gioi-han', 'saleLimited')->name('saleLimited');
        Route::get('/{slug?}', 'detail')->name('detail');
        Route::get('/render-modal/{id?}', 'renderModalProduct')->name('render');
        Route::get('/detailModal/{id}', 'detailModal')->name('detailModal');
        Route::get('/find/find-variation-by-attribute-ids', 'findVariationByAttributeVariationIds')->name('findVariationByAttributeVariationIds');
        Route::get('/filter/all', 'searchProduct')->name('search');
        Route::post('/{slug}/danh-gia', 'review')->name('review');
    });

Route::controller(App\Http\Controllers\ShoppingCart\ShoppingCartController::class)
    ->prefix('/gio-hang')
    ->as('cart.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/load-cart', 'getCartItems')->name('items');
        Route::post('/', 'store')->name('store');
        Route::put('/', 'update')->name('update');
        Route::post('/apply', 'applyDiscountCode')->name('applyCode');
        Route::post('/increament', 'increament')->name('increament');
        Route::post('/decreament', 'decreament')->name('decreament');
        Route::delete('/remove/{id?}', 'delete')->name('remove');
        Route::post('/buy-now', 'buyNow')->name('buyNow');
        Route::get('/thanh-toan', 'checkout')->name('checkout');
        Route::get('/vnpay', 'handleVnpay')->name('handleVnpay');
        Route::get('/vnpay/return', 'handleVnpayReturn')->name('handleVnpayReturn');
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
        Route::post('/register', 'register')->name('register');
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

Route::controller(App\Http\Controllers\Auth\ResetPasswordApiController::class)
    ->prefix('/reset-password-api')
    ->as('password.reset.api')
    ->group(function () {
        Route::get('/edit', 'edit')->name('edit')->middleware('signed');
        Route::put('/update', 'update')->name('update');
        Route::get('/success', 'success')->name('success');
    });

Route::controller(App\Http\Controllers\Auth\ActiveAccountController::class)
    ->prefix('/activate-account')
    ->as('activation')
    ->group(function () {
        Route::get('/', 'index')->name('index')->middleware('signed');
    });

Route::controller(App\Http\Controllers\Order\OrderController::class)
    ->prefix('/don-hang')
    ->as('order.')
    ->group(function () {
        Route::get('/', 'indexUser')->name('indexUser');
        Route::get('/chi-tiet/{id}', 'detail')->name('detail');
        Route::get('/huy/{id?}', 'cancel')->name('cancel');
        Route::get('/danh-gia/{id?}', 'review')->name('review');
        Route::get('/danh-gia/{id}/chi-tiet', 'review_detail')->name('review_detail');
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
        ->prefix('/tai-khoan')
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
    ->as('post.')
    ->group(function () {
        Route::get('/tin-tuc', 'index')->name('index');
        Route::get('/{slug}', function ($slug) {
            $postCategory = \App\Models\PostCategory::where('slug', $slug)->first();
            if ($postCategory) {
                return App::make(App\Http\Controllers\Post\PostController::class)->category($slug);
            }

            $post = \App\Models\Post::where('slug', $slug)->first();
            if ($post) {
                return App::make(App\Http\Controllers\Post\PostController::class)->detail($slug);
            }

            abort(404);
        })->name('fallback');
    });
