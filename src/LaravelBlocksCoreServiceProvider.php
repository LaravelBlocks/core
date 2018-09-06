<?php

namespace LaravelBlocks\Core;

use Illuminate\Support\ServiceProvider;

class LaravelBlocksCoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }

    public function register()
    {
        //
    }
}
