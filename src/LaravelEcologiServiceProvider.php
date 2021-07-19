<?php

namespace IndustriousAgency\EcologiLaravel;

use Illuminate\Support\ServiceProvider;

class LaravelEcologiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('ecologi.api', function() {
            return new LaravelEcologi();
        });
    }
}
