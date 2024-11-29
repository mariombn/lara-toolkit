<?php

namespace LaraToolkit\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use LaraToolkit\Helpers\ValidatorHelper;

class LaraToolkitServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            return ValidatorHelper::cpf($value);
        });

        Validator::extend('cnpj', function ($attribute, $value, $parameters, $validator) {
            return ValidatorHelper::cnpj($value);
        });

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return ValidatorHelper::phone($value);
        });

        Validator::extend('celphone', function ($attribute, $value, $parameters, $validator) {
            return ValidatorHelper::celphone($value);
        });

        Validator::extend('cep', function ($attribute, $value, $parameters, $validator) {
            return ValidatorHelper::cep($value);
        });

        Validator::extend('passport', function ($attribute, $value, $parameters, $validator) {
            return ValidatorHelper::passport($value);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                \LaraToolkit\Commands\MakeServiceCommand::class,
                \LaraToolkit\Commands\MakeRepositoryCommand::class,
            ]);
        }
    }
}
