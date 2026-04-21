<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/community', [PostController::class, 'index'])->name('community.index');
Route::post('/community/create', [PostController::class, 'store'])->name('community.store');
Route::put('/community/update/{id}', [PostController::class, 'update'])->name('community.update');
Route::delete('/community/delete/{id}', [PostController::class, 'destroy'])->name('community.destroy');