<?php

namespace App\Providers;

use App\Models\EquipmentAllocation;
use App\Policies\EquipmentAllocationPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::before( function ($user , $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

        Gate::policy(EquipmentAllocation::class, EquipmentAllocationPolicy::class);
    }
}
