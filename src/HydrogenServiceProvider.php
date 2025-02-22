<?php

namespace MBoateng\Hydrogen;

use Illuminate\Support\ServiceProvider;

class HydrogenServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $config = realpath(__DIR__ . '/../config/hydrogenpay.php');

        $this->publishes([
            $config => config_path('hydrogenpay.php')
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('hydrogenpay-laravel', function ($app) {
            return new Hydrogen($app->make("request"));
        });

        $this->app->alias('hydrogenpay-laravel', "Mboateng\Hydrogen\Hydrogen");
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['hydrogenpay-laravel'];
    }
}
