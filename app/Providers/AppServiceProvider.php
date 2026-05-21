<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
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
        // Admin dan Customer bisa melihat data
        Gate::define('view-data', function (User $user) {
            return $user->role === 'admin' || $user->role === 'customer';
        });

        // Hanya Admin yang bisa menambah data
        Gate::define('store-data', function (User $user) {
            return $user->role === 'admin';
        });

        // Hanya Admin yang bisa mengedit data
        Gate::define('edit-data', function (User $user) {
            return $user->role === 'admin';
        });

        // Hanya Admin yang bisa menghapus data
        Gate::define('destroy-data', function (User $user) {
            return $user->role === 'admin';
        });

        // Admin dan Customer bisa membuat rental
        Gate::define('create-rental', function (User $user) {
            return $user->role === 'admin' || $user->role === 'customer';
        });
    }
}
