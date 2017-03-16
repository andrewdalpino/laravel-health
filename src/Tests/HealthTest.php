<?php

namespace AndrewDalpino\LaravelHealth\Tests;

interface HealthTest
{
    /**
     * Run the health check.
     *
     * @return boolean
     */
    public function run();

    /**
     * The name of the test.
     *
     * @return [type]
     */
    public function name();
}
