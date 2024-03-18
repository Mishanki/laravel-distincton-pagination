<?php

namespace Larahook\DistinctOnPagination;

use Illuminate\Support\ServiceProvider;

class DistinctOnPaginationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/distincton.php', 'distincton');
    }

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/distincton.php' => config_path('distincton.php'),
            ], 'config');
        }
    }
}
