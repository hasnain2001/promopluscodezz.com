<?php

use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\Localization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () { return view('welcome');});

    // Route::get('/dashboard', function () {return view('dashboard');})->middleware()->name('dashboard');

    Route::middleware(['auth', 'role:user'])->group( function(){
        Route::get('/dashboard', function () {  return view('dashboard');})->name('dashboard');
    });
  Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    });
  Route::middleware([Localization::class])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/{lang?}', 'index')->name('home');
        Route::get('/{lang?}/stores', 'stores')->name('stores');
        Route::get('store/{slug}', function($slug) {return app(HomeController::class)->StoreDetails('en', $slug, request());})->name('store.detail');
        Route::get('/{lang}/store/{slug}', [HomeController::class, 'StoreDetails'])->name('store_details.withLang');
        Route::get('{lang?}/category', 'category')->name('category');
        Route::get('/category/{slug}',function($slug) {return app(HomeController::class)->category_detail('en', $slug, request());})->name('category.detail');
       Route::get('{lang?}/category/{slug}', 'category_detail')->name('category.detail.withlang');
        Route::get('{lang?}/coupon', 'coupons')->name('coupons');
        Route::get('{lang?}/deal', 'deal')->name('deals');
        Route::get('{lang?}/coupon/{slug}', 'coupon_detail')->name('coupon.detail');
        Route::get('{lang?}/blog', 'blog')->name('blog');
        Route::get('/blog/{slug}',function($slug) {return app(HomeController::class)->blog_detail('en', $slug, request());})->name('blog.detail');
        Route::get('/{lang}/blog/{slug}', 'blog_detail')->name('blog-details.withLang');
       });
      });

     Route::controller(SearchController::class)->group(function () {
            Route::get('/Search/Store', 'search')->name('search');
            Route::get('/Search/Stores', 'searchResults')->name('search_results');
     });
    Route::controller(CouponController::class)->group(function () {
        Route::post('/update-clicks', 'updateClicks')->name('update.clicks');
        Route::get('/clicks/{couponId}',  'openCoupon')->name('open.coupon');
     });
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::get('/language/create', function() { return view('language.create');})->name('langauge.create');
    Route::get('/language/edit/{id}', function($id) {  return view('language.edit', ['id' => $id]);});
    Route::get('/language', function() {    return view('language.index');});
    Route::get('/chat', function () { $users = User::where('id', '!=', Auth::id())->get();return view('chat.chat-list', compact('users'));})->middleware('auth')->name('chat-list');

    Route::get('/chat/{id}', function ($id) {$receiver = User::findOrFail($id);return view('chat.chat', compact('receiver'));})->middleware('auth')->name('chat');
    require __DIR__.'/auth.php';
    require __DIR__.'/admin.php';
    require __DIR__.'/employee.php';
