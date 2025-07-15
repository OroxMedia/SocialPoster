<?php

namespace Orox\SocialPoster;

use Illuminate\Support\ServiceProvider;

class SocialPosterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'socialposter');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'socialposter');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('socialposter.php'),
        ], 'config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/socialposter'),
        ], 'views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/socialposter'),
        ], 'assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/socialposter'),
        ], 'lang');*/

        // Registering package commands.
        // $this->commands([]);

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'socialposter');

        // Register the main class to use with the facade
        $this->app->singleton('socialposter', function () {
            return new SocialPoster;
        });
    }
}
