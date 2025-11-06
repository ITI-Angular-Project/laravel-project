<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// unAuth
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('about-us', fn() => view('pages.main.about-us'))->name('about');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

Route::prefix('/dashboard')->controller(DashboardController::class)->name('dashboard.')->middleware(['auth', 'verified', 'role:' . implode(',', [User::ROLE_ADMIN, User::ROLE_EMPLOYER])])->group(function () {
    Route::get('', 'index')->name('home');
    Route::get('/jobs', 'jobs')->name('jobs');
    Route::get('/applications', 'applications')->name('applications');
    Route::get('/profile', 'profile')->name('profile');
});

Route::middleware(['auth', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::resource('users', UserController::class);


    Route::get('/jobs', [JobController::class, 'dashboardIndex'])->name('jobs.index');
    // Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    // Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    // Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    // Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    // Route::get('/jobs/{job}', [JobController::class, 'show'])->name('dashboard.jobs.show');
    // Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('dashboard.jobs.edit');
    Route::resource('jobs', JobController::class)->except('index');
});

Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
