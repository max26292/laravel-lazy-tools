<?php

namespace Max26292\LaravelLazyTools\ServiceProvider;

use Illuminate\Support\ServiceProvider;
use Max26292\LaravelLazyTools\Commands\CreateInterface;
use Max26292\LaravelLazyTools\Commands\CreateRepository;
use Max26292\LaravelLazyTools\Commands\CreateService;
use Max26292\LaravelLazyTools\Helpers\ResponseFormatterHelper;

class LaravelLazyToolsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(([
                CreateInterface::class,
                CreateRepository::class,
                CreateService::class
            ]));
        }
    }

    public function register()
    {
        $this->app->bind('response-formatter-helper', function ($app) {
            return new ResponseFormatterHelper();
        });
    }
}
