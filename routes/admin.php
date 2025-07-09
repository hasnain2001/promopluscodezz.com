<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\StoresController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\DeleteRequestController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\NetworkController;
use App\Http\Controllers\admin\SearchController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth','role:admin'])->group(function () {

    Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/users', 'index')->name('user.index');
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user/store', 'store')->name('user.store');
    Route::get('/user/edit/{id}', 'edit')->name('user.edit');
    Route::put('/user/update/{id}', 'update')->name('user.update');
    Route::delete('/users/{id}',  'destroy')->name('user.destroy');
    Route::get('/user/checkin/{id}', 'show')->name('user.show');
    });

    Route::controller(LanguageController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/languages', 'index')->name('language.index');
    Route::get('/language/create', 'create')->name('language.create');
    Route::post('/language/store', 'store')->name('language.store');
    Route::get('/language/edit/{language}', 'edit')->name('language.edit');
    Route::put('/language/update/{language}', 'update')->name('language.update');
    Route::delete('/language/delete/{language}',  'destroy')->name('language.destroy');
    Route::get('/language/{id}', 'show')->name('language.show');
    });

    Route::controller(CategoryController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', 'index')->name('category.index');
    Route::get('/Category/Create', 'create')->name('category.create');
    Route::post('/category/store', 'store')->name('category.store');
    Route::get('/category/edit/{category}', 'edit')->name('category.edit');
    Route::put('/category/update/{category}', 'update')->name('category.update');
    Route::delete('/categories/{id}',  'destroy')->name('category.destroy');
    Route::get('/category/{id}', 'show')->name('category.show');
    Route::post('/category/deleteSelected', 'deleteSelected')->name('category.deleteSelected');
    Route::get('/category/checkslug',  'checkSlug')->name('category.checkslug');
    });

    Route::controller(StoresController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/store', 'index')->name('store.index');
    Route::get('/stores/create', 'create')->name('store.create');
    Route::post('/store/store', 'store')->name('store.store');
    Route::get('/store/edit/{stores}', 'edit')->name('store.edit');
    Route::put('/store/update/{stores}', 'update')->name('store.update');
    Route::delete('/store/{id}',  'destroy')->name('store.destroy');
    Route::get('/stores/{slug}', 'show')->name('store.show');
    Route::get('/store/detail/{slug}', 'Store_detail')->name('store.detail');
    Route::delete('/store/deleteSelected', 'deleteSelected')->name('store.deleteSelected');
    });

    Route::controller(NetworkController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/network', 'index')->name('network.index');
    Route::get('/network/create', 'create')->name('network.create');
    Route::post('/network/store', 'store')->name('network.store');
    Route::get('/network/edit/{network}', 'edit')->name('network.edit');
    Route::put('/network/update/{network}', 'update')->name('network.update');
    Route::delete('/network/{network}',  'destroy')->name('network.destroy');

    });
    Route::controller(CouponController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/Coupon', 'index')->name('coupon.index');
    Route::get('/Coupon/Create', 'create')->name('coupon.create');
    Route::post('/coupon/store', 'store')->name('coupon.store');
    Route::get('/coupon/edit/{coupon}', 'edit')->name('coupon.edit');
    Route::put('/coupon/update/{coupon}', 'update')->name('coupon.update');
    Route::delete('/coupon/delete/{coupon}',  'destroy')->name('coupon.destroy');
    Route::get('/coupon/{coupon}', 'show')->name('coupon.show');
    Route::post('coupon/update-order','updateOrder')->name('coupon.update-order');
    Route::post('/coupon/deleteSelected', 'deleteSelected')->name('coupon.deleteSelected');
        });
    Route::controller(BlogController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/Blog', 'index')->name('blog.index');
    Route::get('/Blog/Create', 'create')->name('blog.create');
    Route::post('/blog/store', 'store')->name('blog.store');
    Route::get('/blog/edit/{blog}', 'edit')->name('blog.edit');
    Route::put('/blog/update/{blog}', 'update')->name('blog.update');
    Route::delete('/blog/delete/{blog}',  'destroy')->name('blog.destroy');
    Route::get('/Blog/{slug}', 'show')->name('blog.show');
    Route::post('/blog/deleteSelected', 'deleteSelected')->name('blog.deleteSelected');
    });

    Route::controller(SearchController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/search/store', 'searchStores')->name('search.store');
    Route::get('/search/store/coupons', 'searchStoresCoupons')->name('search.store.coupons');
    Route::get('/search',  'search')->name('search');
    Route::get('/search_results',  'searchResults')->name('search_results');
    });

    Route::controller(DeleteRequestController::class)->prefix('admin')->group(function () {
       Route::get('/delete-requests',  'index')->name('admin.delete.requests');
        Route::post('/delete-requests/{id}/approve',  'approve')->name('admin.delete.approve');
        Route::post('/delete-requests/{id}/reject',  'reject')->name('admin.delete.reject');
    });

    Route::controller(SliderController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/slider', 'index')->name('slider.index');
    Route::get('/slider/create', 'create')->name('slider.create');
    Route::post('/slider/store', 'store')->name('slider.store');
    Route::get('/slider/edit/{slider}', 'edit')->name('slider.edit');
    Route::put('/slider/update/{slider}', 'update')->name('slider.update');
    Route::delete('/slider/delete/{slider}',  'destroy')->name('slider.destroy');
    Route::get('/slider/{slider}', 'show')->name('slider.show');
    Route::post('/slider/deleteSelected', 'deleteSelected')->name('slider.deleteSelected');
    Route::post('slider/update-order','updateOrder')->name('slider.update-order');
    Route::post('/slider/bulk-delete', 'bulkDelete')->name('slider.bulkDelete');
    Route::post('/slider/bulk-update', 'bulkUpdate')->name('slider.bulkUpdate');
    Route::post('/slider/bulk-status-update', 'bulkStatusUpdate')->name('slider.bulkStatusUpdate');
       // Additional routes from enhancements
    Route::patch('/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('slider.toggle-status');
    Route::get('/export', [SliderController::class, 'export'])->name('slider.export');

});

});


