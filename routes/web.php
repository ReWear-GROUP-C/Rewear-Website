<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CO2Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// [PBI-01] Admin Routes to define and manage CO2 constants
Route::post('/admin/categories', [CO2Controller::class, 'addCategory']);
Route::put('/admin/categories/{id}/co2-constant', [CO2Controller::class, 'updateCategoryCO2']);
Route::delete('/admin/categories/{id}', [CO2Controller::class, 'deleteCategory']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
