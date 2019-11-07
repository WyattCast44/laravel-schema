<?php

namespace WyattCast44\LaravelSchema;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Events\MigrationsEnded;
use WyattCast44\LaravelSchema\Commands\GenerateDatabaseSchemaFiles;

class LaravelSchemaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        Event::listen(MigrationsEnded::class, function () {
            Artisan::call('schema:generate');
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/schema.php', 'schema');

        // Register the service the package provides.
        $this->app->singleton('laravel-schema', function ($app) {
            return new LaravelSchema;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-schema'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/schema.php' => config_path('schema.php'),
        ], 'schema.config');

        $this->commands([
            GenerateDatabaseSchemaFiles::class,
        ]);
    }
}
