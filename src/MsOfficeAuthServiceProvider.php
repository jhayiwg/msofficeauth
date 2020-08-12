<?php

namespace LaraOffice\MsOfficeAuth;

use Illuminate\Support\ServiceProvider;
use LaraOffice\MsOfficeAuth\MsOfficeAuth;

class MsOfficeAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'msofficeauth');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'msofficeauth');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        
        //$this->app->make('LaraOffice\MsOfficeAuth\Controllers');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('msofficeauth.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/msofficeauth'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/msofficeauth'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/msofficeauth'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'msofficeauth');

        // Register the main class to use with the facade
        $this->app->singleton(MsOfficeAuth::class, function () {
            return new MsOfficeAuth;
        });
    }
    public function provides()
    {
        return [MsOfficeAuth::class];
    }
}
