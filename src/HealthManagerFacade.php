<?php

namespace AndrewDalpino\LaravelHealth;

use Illuminate\Support\Facades\Facade;

class HealthManagerFacade extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'health_manager';
    }
}
