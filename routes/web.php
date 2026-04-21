<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CO2Controller;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


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

    // Orders 
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    // Route::get('/orders/{order}/confirmation', [OrderController::class, 'confirmation'])->name('orders.confirmation');
});


require __DIR__.'/auth.php';