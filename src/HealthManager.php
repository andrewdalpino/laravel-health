<?php

namespace AndrewDalpino\LaravelHealth;

use AndrewDalpino\LaravelHealth\Tests\HealthTest;

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
            $this->queueTest($test);
        }
    }

    /**
     * Queue up a test.
     *
     * @param  \AndrewDalpino\LaravelHealth\Tests\HealthTest  $test
     * @return void
     */
    public function queueTest(HealthTest $test)
    {
        $this->tests[] = $test;
    }

    /**
     * Run the health tests and generate a report.
     *
     * @return \AndrewDalpino\LaravelHealth\HealthCheckResult
     */
    public function check()
    {
        $report = new HealthCheckReport();

        foreach ($this->tests as $test) {
            try {
                $start = microtime(true);

                $result = $test->run();

                $millis = round((microtime(true) - $start) * 1000);

                $report->addResult($test->name(), $result['value'], $result['passed'], $millis);
            } catch (\Exception $e) {
                //
            }
        }

        return $report;
    }
}
