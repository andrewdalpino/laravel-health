<?php

namespace AndrewDalpino\LaravelHealth;

use AndrewDalpino\LaravelHealth\HealthManager;
use AndrewDalpino\LaravelHealth\Tests\DatabaseConnectionTest;
use AndrewDalpino\LaravelHealth\Tests\ServerLoadTest;
use AndrewDalpino\LaravelHealth\Tests\FreeDiskSpaceTest;
use Illuminate\Support\ServiceProvider;

class LaravelHealthServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred until requested by the container.
     *
     * @var  boolean  $defer
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/health.php' => $this->configPath('health.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HealthManager::class, function ($app) {
            return new HealthManager([
                new DatabaseConnectionTest($app['db']),
                new ServerLoadTest(),
                new FreeDiskSpaceTest()
            ]);
        });

        $this->app->alias(HealthManager::class, 'health_manager');
    }

    /**
     * Get the configuration path.
     *
     * @param  string  $path
     * @return string
     */
     protected function configPath($path = '')
     {
         return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
     }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            HealthManager::class,
            'health_manager',
        ];
    }
}
