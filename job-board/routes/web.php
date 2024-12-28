<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use App\Models\Work;
use Illuminate\Support\Facades\Route;

;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('',fn() => to_route('jobs.index'));

Route::resource('jobs', controller: WorkController::class);

require __DIR__.'/auth.php';