<?php

namespace Industrious\LaravelEcologi;

use Illuminate\Support\ServiceProvider;
use Industrious\LaravelEcologi\Exceptions\LaravelEcologiApiKeyNotFound;

class LaravelEcologiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/ecologi.php',
            'ecologi'
        );

        $this->app->singleton(LaravelEcologi::class, function () {
            $apiKey = config('ecologi.api_key');

            if (! $apiKey) {
                throw new LaravelEcologiApiKeyNotFound('Ecologi API Key not set');
            }

            return new LaravelEcologi($apiKey);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config' => config_path(),
        ], 'config');
    }
}
