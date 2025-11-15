<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SocialiteAuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// ✅ Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/job/{id}', [JobController::class, 'details'])->name('job.details');
Route::get('/jobs/{job}/comments', [JobController::class, 'getComments'])->name('jobs.comments');

Route::get('about-us', fn() => view('pages.main.about-us'))->name('about');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');


// ✅ Apply Job Feature Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/job/{job}/apply', [ApplicationController::class, 'apply'])
        ->name('apply.job');

    Route::get('/job/{job}/complete-profile', [ApplicationController::class, 'completeProfile'])
        ->name('apply.complete-profile');

    Route::post('/job/{job}/submit-profile', [ApplicationController::class, 'submitProfile'])
        ->name('apply.submit-profile');

    // Route::post('/jobs/{job}/comment', [CommentController::class, 'store'])->name('jobs.comment.store');
});


// ✅ Admin + Employer Dashboard Routes
Route::prefix('/dashboard')->controller(DashboardController::class)
    ->name('dashboard.')
    ->middleware(['auth', 'verified', 'role:' . implode(',', [User::ROLE_ADMIN, User::ROLE_EMPLOYER])])
    ->group(function () {
        Route::get('', 'index')->name('home');
        Route::get('/jobs', [JobController::class, 'dashboardIndex'])->name('jobs');
        Route::get('/applications', 'applications')->name('applications');

        Route::get('/profile', 'profile')->name('profile');
        Route::patch('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::delete('/profile', [DashboardController::class, 'destroyProfile'])->name('profile.destroy');
    });


// ✅ Dashboard Shared Auth Routes
Route::middleware(['auth', 'verified', 'role:admin,employer'])->name('dashboard.')->prefix('dashboard')->group(function () {

    Route::resource('users', UserController::class)->middleware('role:admin');
    Route::get('/jobs', [JobController::class, 'dashboardIndex'])->name('jobs.index');
    Route::resource('jobs', JobController::class)->except('index');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read', [NotificationController::class, 'markRead'])->name('notifications.mark-read');

    Route::patch('jobs/{job}/approve', [JobController::class, 'approve'])
        ->name('jobs.approve')
        ->middleware('role:' . User::ROLE_ADMIN);

    Route::patch('jobs/{job}/reject', [JobController::class, 'reject'])
        ->name('jobs.reject')
        ->middleware('role:' . User::ROLE_ADMIN);

    Route::middleware('role:' . User::ROLE_EMPLOYER)->group(function () {
        Route::get('/company', [CompanyController::class, 'edit'])->name('company.edit');
        Route::put('/company', [CompanyController::class, 'update'])->name('company.update');
    });

    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
    });

    // ✅ Employers manage applications
    Route::resource('applications', ApplicationController::class)->only(['index', 'show', 'update', 'destroy']);

    // Delete comment route (to fix your error)
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy')
        ->middleware('auth');
});


// // ✅ User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Candidate – View My Applications
Route::middleware(['auth'])->group(function () {
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])
        ->name('candidate.applications');
});


Route::get('/notifications/mark-all-read', function () {
    if (Auth::check()) {
        Auth::user()->unreadNotifications->markAsRead();
    }
    return response()->json(['status' => 'ok']);
})->name('notifications.markAllRead')->middleware('auth');



Route::middleware(['auth', 'verified', 'role:candidate'])->group(function () {
    Route::post('/apply/{job}', [ApplicationController::class, 'apply'])->name('apply');
});




require __DIR__ . '/auth.php';
