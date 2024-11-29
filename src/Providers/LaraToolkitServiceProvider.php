<?php

namespace LaraToolkit\Providers;

use Illuminate\Support\ServiceProvider;

class LaraToolkitServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \LaraToolkit\Commands\MakeServiceCommand::class,
                \LaraToolkit\Commands\MakeRepositoryCommand::class,
            ]);
        }
    }
}
