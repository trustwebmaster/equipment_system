<?php

namespace App\Providers;

use App\Interfaces\EquipmentAllocationInterface;
use App\Interfaces\EquipmentInterface;
use App\Interfaces\UserInterface;
use App\Repositories\EquipmentAllocationRepository;
use App\Repositories\EquipmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class,UserRepository::class);
        $this->app->bind(EquipmentInterface::class,EquipmentRepository::class);
        $this->app->bind(EquipmentAllocationInterface::class,EquipmentAllocationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
