<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\JobApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\MyPostJobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use App\Models\Employer;
use App\Models\JobApplication;
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


Route::middleware('auth')->group(function () {
    Route::resource('jobs.application', JobApplicationController::class)
    ->scoped()
    ->only('create','store');

    Route::resource('jobsapplication', controller: MyJobController::class)
    ->only([ 'index','destroy']);

    Route::middleware('employer')->resource('my-jobs', MyPostJobController::class);


    Route::resource('employer',controller: EmployerController::class)->only(['create','store']);
});



Route::get('/login',fn() => to_route('auth.create'));
Route::resource('auth',AuthController::class)->only(['create','store']);
Route::delete('logout',fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth',[AuthController::class,'destroy'])->name('auth.destroy');

require __DIR__.'/auth.php';
