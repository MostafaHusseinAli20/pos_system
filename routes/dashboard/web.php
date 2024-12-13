<?php

use App\Http\Controllers\Dashboard\Categories\MainCategoryController;
use App\Http\Controllers\Dashboard\Clients\MainClientController;
use App\Http\Controllers\Dashboard\Clients\Orders\OrderController;
use App\Http\Controllers\Dashboard\Orders\MainOrderController;
use App\Http\Controllers\Dashboard\Products\CreateProductController;
use App\Http\Controllers\Dashboard\Products\MainProductController;
use App\Http\Controllers\Dashboard\WelcomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Roles\MainRoleController;
use App\Http\Controllers\Dashboard\Users\MainUserController;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('dashboard')->middleware(['auth'])->group(function () {
            Route::get('/', [WelcomeController::class, 'index'])->name('dashboard.index');

        });

        Route::group(['middleware' => ['auth']], function () {
        
            // categories routes
            Route::resource('categories', MainCategoryController::class);

            // products routes
            Route::resource('products', MainProductController::class);

            // clients routes
            Route::resource('clients', MainClientController::class);
            Route::resource('clients.orders', OrderController::class);

            // orders routes
            Route::resource('orders', MainOrderController::class);
            Route::get('/orders/{order}/products', [MainOrderController::class, 'products'])->name('orders.products');

            // users routes
            Route::resource('users', MainUserController::class);

            // Roles routes
            Route::resource('roles', MainRoleController::class);

            // MarkAsRead Notification
            Route::get('MarkAsRead', [CreateProductController::class, 'MarkAsRead'])->name('MarkAsRead');
        });
    });
