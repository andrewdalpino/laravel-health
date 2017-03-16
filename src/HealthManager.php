<?php

namespace AndrewDalpino\LaravelHealth;

use AndrewDalpino\LaravelHealth\Tests\HealthTest;
use AndrewDalpino\LaravelHealth\HealthCheckResult;

class HealthManager
{
    /**
     * The tests to run during the health check.
     *
     * @var  array  $tests
     */
    protected $tests = [
        //
    ];

    /**
     * Constructor.
     *
     * @param  array  $tests
     * @return void
     */
    public function __construct(array $tests)
    {
        foreach ($tests as $test) {
            if ($test instanceof HealthTest) {
                $this->tests[] = $test;
            }
        }
    }

    /**
     * Run the health tests.
     *
     * @return \AndrewDalpino\LaravelHealth\HealthCheckResult
     */
    public function check()
    {
        $result = new HealthCheckResult();

        foreach ($this->tests as $test) {
            $result->addResult($test->name(), $test->run());
        }

        return $result;
    }
}
