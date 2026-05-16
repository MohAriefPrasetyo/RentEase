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
        // Gate untuk melihat equipment (Admin dan Customer)
        Gate::define('view-data', function (User $user) {
            return $user->role === 'admin' || $user->role === 'customer';
        });

        // Gate untuk menambah/edit/hapus data (Hanya Admin)
        Gate::define('store-data', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('edit-data', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('destroy-data', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk booking rental (Admin dan Customer)
        Gate::define('create-rental', function (User $user) {
            return $user->role === 'admin' || $user->role === 'customer';
        });
    }
}
