<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Models\User;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/dashboard')->controller(DashboardController::class)->name('dashboard.')->middleware(['auth', 'verified', 'role:'. implode(',', [User::ROLE_ADMIN, User::ROLE_EMPLOYER])])->group(function () {
    Route::get('', 'index')->name('home');
    Route::get('/jobs', 'jobs')->name('jobs');
    Route::get('/applications', 'applications')->name('applications');
    Route::get('/profile', 'profile')->name('profile');
});

Route::middleware(['auth', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::resource('jobs', JobController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
