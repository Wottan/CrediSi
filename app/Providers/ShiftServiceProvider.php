<?php

namespace App\Providers;

use App\Services\ShiftService;
use Illuminate\Support\ServiceProvider;

class ShiftServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\ShiftService', function () {
            return new ShiftService();
          });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
