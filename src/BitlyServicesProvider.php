<?php

namespace BitlyShortener;

use Illuminate\Support\ServiceProvider;

class BitlyServicesProvider  extends ServiceProvider
{

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/bitlyconfig.php' => config_path('bitlyconfig.php'),
        ], 'bitlyconfig');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/bitlyconfig.php',
            'bitlyconfig'
        );
    }
}
