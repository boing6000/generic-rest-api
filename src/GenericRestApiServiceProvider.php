<?php

namespace Wilgucki\GenericRestApi;

use Illuminate\Support\ServiceProvider;

class GenericRestApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/generic-rest-api.php' => config_path(
                'generic-rest-api.php'
            )
        ]);

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }

    public function register()
    {
    }
}
