<?php

namespace App\Providers;

use App\Interfaces\CustomerRepositoryInterfaces;
use App\Interfaces\RoomsRepositoryInterfaces;
use App\Interfaces\RoomTypeRepositoryInterfaces;
use App\Repositories\CustomerRepository;
use App\Repositories\RoomsRepository;
use App\Repositories\RoomTypeRepository;
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
        $this->app->bind(RoomTypeRepositoryInterfaces::class, RoomTypeRepository::class);
        $this->app->bind(RoomsRepositoryInterfaces::class, RoomsRepository::class);
        $this->app->bind(CustomerRepositoryInterfaces::class, CustomerRepository::class);
    }
}
