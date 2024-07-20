<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class SupaAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
                Gate::before(function ($user, $ability) {
                         if ($user->hasRole('super-admin')) {
                                 return true;
                        }
                });
    }
}
