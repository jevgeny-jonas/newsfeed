<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\NewsReaderInterface', 'App\NewsReader');
        
        //using superinterface to not be bound to Laravel-specific interface
        $this->app->bind('Psr\SimpleCache\CacheInterface', function () {
            return $this->app->make('Illuminate\Contracts\Cache\Repository');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
