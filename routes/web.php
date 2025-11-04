<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/dashboard')->controller(DashboardController::class)->name('dashboard.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('', 'index')->name('home');
    Route::get('/jobs', 'jobs')->name('jobs');
    Route::get('/applications', 'applications')->name('applications');
    Route::get('/profile', 'profile')->name('profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
