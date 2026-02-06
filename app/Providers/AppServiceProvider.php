<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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
        // Mendefinisikan izin 'admin-access'
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'admin';
        });
        // if (app()->environment('local')) {
        //     URL::forceScheme('https');
        // }
    }
}
