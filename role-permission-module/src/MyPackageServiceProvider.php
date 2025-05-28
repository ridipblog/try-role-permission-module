<?php

namespace BugLock\rolePermissionModule;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class MyPackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/codes.php', 'role-permission-codes');
        logger('Module registered ');
    }

    public function boot()
    {
        // Load all migration files 
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        //Publish package config files in laravel-app/config folder
        //publish command -> php artisan vendor:publish --tag=role-permission-config
        $this->publishes([
            __DIR__ . '/config/codes.php' => config_path('codes.php')
        ], 'role-permission-config');

        //Publish package config files in laravel-app/app/models folder
        //publish command -> php artisan vendor:publish --tag=role-permissions-models
        $this->publishes(collect(File::allFiles(__DIR__ . '/Models'))
            ->flatMap(fn($file) => [$file->getPathname() => app_path('Models/' . $file->getFilename())])
            ->toArray(), 'role-permissions-models');

            //Load all middleware (Set as alise middleware )
            $router=$this->app['router'];

            //Load Auth middleware 
            $router->aliasMiddleware('buglock.auth',\BugLock\rolePermissionModule\Http\Middlewares\BugLockAuth::class);

            //Load Role middleware
            $router->aliasMiddleware('buglock.role',\BugLock\rolePermissionModule\Http\Middlewares\BugLockRole::class);

    }
}
