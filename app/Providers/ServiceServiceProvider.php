<?php

namespace App\Providers;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\Shipment\ShipmentServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Services\Auth\AuthService;
use App\Services\Shipment\ShipmentService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ShipmentServiceInterface::class, ShipmentService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
