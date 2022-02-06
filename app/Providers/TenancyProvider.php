<?php

namespace App\Providers;

use App\Tenant;
use Illuminate\Support\ServiceProvider;

class TenancyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $host = $this->app["request"]->getHost();
        if (!$this->app->runningInConsole() && $host != env("APP_URL")) {
            Tenant::whereDomain($host)->firstOrFail()->config()->set();
        }
    }
}
