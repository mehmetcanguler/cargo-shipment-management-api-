<?php

namespace App\Providers;

use App\Contracts\Repositories\ReadRepositoryInterface;
use App\Contracts\Repositories\Shipment\ShipmentReadRepositoryInterface;
use App\Contracts\Repositories\Shipment\ShipmentWriteRepositoryInterface;
use App\Contracts\Repositories\User\UserReadRepositoryInterface;
use App\Contracts\Repositories\User\UserWriteRepositoryInterface;
use App\Contracts\Repositories\WriteRepositoryInterface;
use App\Repositories\ReadRepository;
use App\Repositories\Shipment\ShipmentReadRepository;
use App\Repositories\Shipment\ShipmentWriteRepository;
use App\Repositories\User\UserReadRepository;
use App\Repositories\User\UserWriteRepository;
use App\Repositories\WriteRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WriteRepositoryInterface::class, WriteRepository::class);
        $this->app->bind(ReadRepositoryInterface::class, ReadRepository::class);

        $this->app->bind(UserWriteRepositoryInterface::class, UserWriteRepository::class);
        $this->app->bind(UserReadRepositoryInterface::class, UserReadRepository::class);

        $this->app->bind(ShipmentWriteRepositoryInterface::class, ShipmentWriteRepository::class);
        $this->app->bind(ShipmentReadRepositoryInterface::class, ShipmentReadRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
