<?php

namespace YourVendor\rolePermissionModule;

use Illuminate\Support\ServiceProvider;

class MyPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/codes.php','role-permission-codes');
        logger('Module registered ');
    }

    public function boot()
    {
        // Load all migration files 
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        //Publish package config files in laravel-app/config folder
        //publish command -> php artisan vendor:publish --tag=role-permission-config
        $this->publishes([
            __DIR__.'/config/codes.php'=>config_path('codes.php')
        ],'role-permission-config');

    }
}