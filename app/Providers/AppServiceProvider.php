<?php

namespace App\Providers;

use App\CQRS\QueryBus;
use App\CQRS\CommandBus;
use App\CQRS\QueryBusInterface;
use App\CQRS\CommandBusInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CommandBusInterface::class, CommandBus::class);
        $this->app->singleton(QueryBusInterface::class, QueryBus::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
