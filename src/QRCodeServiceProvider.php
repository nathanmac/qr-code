<?php

namespace Nathanmac\Utilities\QRCode;

use Illuminate\Support\ServiceProvider;

class QRCodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->defineRoutes();
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Define the QRCode routes.
     *
     * @return void
     */
    protected function defineRoutes()
    {
        if (! $this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'Nathanmac\QRCode\Controllers'], function ($router) {
                require __DIR__.'/routes.php';
            });
        }
    }
}