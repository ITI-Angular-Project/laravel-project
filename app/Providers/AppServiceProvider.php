<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('notifications', User::findOrFail(Auth::id())->unreadNotifications()->take(5)->get());
            }
        });
        Gate::define('admin-view', fn(User $user) => $user->role === User::ROLE_ADMIN);
        Gate::define('employer-view', fn(User $user) => $user->role === User::ROLE_EMPLOYER);
        Gate::define('candidate-view', fn(User $user) => $user->role === User::ROLE_CANDIDATE);
        Gate::define('demo-view', fn(User $user) => $user->role === User::ROLE_DEMO);
    }
}
