<?php

namespace AndrewDalpino\LaravelHealth\Tests;

abstract class BaseTester implements HealthTest
{
    /**
     * @return string
     */
    public function name()
    {
        $class = get_class($this);

        return substr($class, strrpos($class, '\\') + 1);
    }
}
