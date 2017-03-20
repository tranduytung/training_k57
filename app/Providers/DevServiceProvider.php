<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DevServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_DEBUG', false) && env('APP_ENV', 'production') === 'local') {
            // Load DebugBar if it is installed
            if (class_exists('Barryvdh\Debugbar\ServiceProvider')) {
                $this->app->register('Barryvdh\Debugbar\ServiceProvider');
                $this->app->alias('Barryvdh\Debugbar\Facade', 'Debugbar');
            }
        }
    }
}
