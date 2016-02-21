<?php

namespace MauricioBernal\EloquentAuditing;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as LaravelApp;
use Illuminate\Support\ServiceProvider;

class EloquentAuditingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupMigrations($this->app);
    }

    /**
     * Setup the migrations.
     *
     * @param Application $app
     */
    protected function setupMigrations( Application $app )
    {
        $source = realpath(__DIR__ . '/../migrations/');
        if ($app instanceof LaravelApp && $app->runningInConsole()) {
            $this->publishes([ $source => database_path('migrations') ], 'migrations');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
