<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceBindServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(
            \App\Services\ResponseServiceInterface::class,
            \App\Services\ResponseService::class
        );
    }
}
