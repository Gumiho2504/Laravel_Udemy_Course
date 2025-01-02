<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;

use Illuminate\Support\Facades\Route;

// Route::get('/external', function () { return view('welcome'); });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('',fn() => to_route('jobs.index'));

Route::resource('jobs', controller: WorkController::class);



Route::get('/login',fn() => to_route('auth.create'));
Route::resource('auth',AuthController::class)->only(['create','store']);

require __DIR__.'/auth.php';
