<?php

use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\employee\BlogController;
use App\Http\Controllers\employee\CategoryController;
use App\Http\Controllers\employee\CouponController;
use App\Http\Controllers\employee\NetworkController;
use App\Http\Controllers\employee\SearchController;
use App\Http\Controllers\employee\StoresController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth','role:employee'])->group(function() {
    Route::controller(EmployeeController::class)->name('employee.')->prefix('employee')->group(function() {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
        Route::controller(CategoryController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/categories', 'index')->name('category.index');
        Route::get('/Category/Create', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{category}', 'edit')->name('category.edit');
        Route::put('/category/update/{category}', 'update')->name('category.update');
        Route::delete('/categories/{id}',  'destroy')->name('category.destroy');
        Route::get('/category/{id}', 'show')->name('category.show');
        });


        Route::controller(StoresController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/store', 'index')->name('store.index');
        Route::get('/storeS/Create', 'create')->name('store.create');
        Route::post('/store/store', 'store')->name('store.store');
        Route::get('/store/edit/{stores}', 'edit')->name('store.edit');
        Route::put('/store/update/{stores}', 'update')->name('store.update');
        Route::delete('/store/{id}',  'destroy')->name('store.destroy');
        Route::get('/Store/{slug}', 'show')->name('store.show');
        Route::delete('/store/deleteSelected', 'deleteSelected')->name('store.deleteSelected');
        Route::get('/store/{slug}/store', 'store_detail')->name('store.details');

        });

        Route::controller(NetworkController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/network', 'index')->name('network.index');
        Route::get('/network/create', 'create')->name('network.create');
        Route::post('/network/store', 'store')->name('network.store');
        Route::get('/network/edit/{network}', 'edit')->name('network.edit');
        Route::put('/network/update/{network}', 'update')->name('network.update');
        Route::delete('/network/{network}',  'destroy')->name('network.destroy');

        });
        Route::controller(CouponController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/Coupon', 'index')->name('coupon.index');
        Route::get('/Coupon/Create', 'create')->name('coupon.create');
        Route::post('/coupon/store', 'store')->name('coupon.store');
        Route::get('/coupon/edit/{coupon}', 'edit')->name('coupon.edit');
        Route::put('/coupon/update/{coupon}', 'update')->name('coupon.update');
        Route::delete('/coupon/delete/{coupon}',  'destroy')->name('coupon.destroy');
        Route::get('/coupon/{coupon}', 'show')->name('coupon.show');
        Route::post('coupon/update-order','updateOrder')->name('coupon.update-order');
        Route::delete('/coupon/deleteSelected', 'deleteSelected')->name('coupon.deleteSelected');

          });

    Route::controller(SearchController::class)->prefix('employee')->name('employee.')->group(function () {
        Route::get('/search/store', 'searchStores')->name('search.store');
        Route::get('/search/store/coupons', 'searchStoresCoupons')->name('search.store.coupons');
        Route::get('/search',  'search')->name('search');
        Route::get('/search_results',  'searchResults')->name('search_results');

        });

        Route::controller(BlogController::class)->prefix('employee')->name('employee.')->group(function () {
            Route::get('/blogs', 'index')->name('blog.index');
            Route::get('/create', 'create')->name('blog.create');
            Route::post('/store', 'store')->name('blog.store');
            Route::get('/edit/{blog}', 'edit')->name('blog.edit');
            Route::put('/update/{blog}', 'update')->name('blog.update');
            Route::delete('/delete/{blog}',  'destroy')->name('blog.destroy');
            Route::get('/Blogs/{slug}', 'show')->name('blog.show');
             Route::post('/deleteSelected', 'deleteSelected')->name('blog.deleteSelected');
            });

});
