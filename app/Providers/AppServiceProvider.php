<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix issue running a version of MySQL older than the 5.7.7 release
        // or MariaDB older than the 10.2.2 release
        // Schema::defaultStringLength(191);

        // Add function check
        Request::macro('isApiRequest', function () {
            return $this->acceptsJson() && $this->is('api/*');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
