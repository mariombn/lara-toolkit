<?php

namespace LaraToolkit\Providers;

use Illuminate\Support\ServiceProvider;

class LaraToolkitServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registre bindings, singletons, etc.
    }

    public function boot()
    {
        // Registre comandos, publique configurações, etc.
        if ($this->app->runningInConsole()) {
            $this->commands([
                \LaraToolkit\Commands\MakeServiceCommand::class,
                \LaraToolkit\Commands\MakeRepositoryCommand::class,
            ]);
        }
    }
}
