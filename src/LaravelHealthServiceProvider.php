<?php

namespace AndrewDalpino\LaravelHealth;

use AndrewDalpino\LaravelHealth\HealthManager;
use AndrewDalpino\LaravelHealth\Tests\DatabaseConnectionTest;
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
            __DIR__ . '/Config/health.php' => $this->config_path('health.php'),
        ]);
        
        include __DIR__ . '/routes.php';
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
                new DatabaseConnectionTest($app['db'])
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
     protected function config_path($path = '')
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
