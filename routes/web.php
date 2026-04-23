<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CO2Controller;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Route::get('/', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('dashboard');

// [PBI-01] Admin Routes to define and manage CO2 constants
Route::post('/admin/categories', [CO2Controller::class, 'addCategory']);
Route::put('/admin/categories/{id}/co2-constant', [CO2Controller::class, 'updateCategoryCO2']);
Route::delete('/admin/categories/{id}', [CO2Controller::class, 'deleteCategory']);

// Marketplace
Route::get('/marketplace', [ItemController::class, 'index'])->name('marketplace.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/restore', [AdminUserController::class, 'restore'])->name('users.restore');

});
require __DIR__.'/auth.php';
