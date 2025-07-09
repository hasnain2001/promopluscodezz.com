<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome');});

// Route::get('/dashboard', function () {return view('dashboard');})->middleware()->name('dashboard');

Route::middleware(['auth', 'role:user'])->group( function(){
    Route::get('/dashboard', function () {  return view('dashboard');})->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/language/create', function() {
    return view('language.create');
})->name('langauge.create');

Route::get('/language/edit/{id}', function($id) {
    return view('language.edit', ['id' => $id]);
});

Route::get('/language', function() {
    return view('language.index'); // You'll need to create this view for listing
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
