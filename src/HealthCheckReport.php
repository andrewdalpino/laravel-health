<?php

namespace AndrewDalpino\LaravelHealth;

class HealthCheckReport
{
    /**
     * The test results.
     *
     * @var  array  $results
     */
    protected $results = [
        //
    ];

    /**
     * Constructor.
     *
     * @param  array  $results
     * @return void
     */
    public function __construct(array $results = [])
    {
        foreach ($results as $result) {
            $this->addResult($result['name'], $result['value'], $result['passed'], $result['time']);
        }
    }

    /**
     * Add a test result to the set.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @param  boolean  $passed
     * @param  int  $millis
     * @return void
     */
    public function addResult($name, $value, $passed, $millis = null)
    {
        $this->results[$name] = [
            'value' => $value,
            'passed' => (bool) $passed,
            'time_ms' => (int) $millis,
        ];
    }

    /**
     * Did the service pass all the tests?
     *
     * @return boolean
     */
    public function success()
    {
        foreach ($this->results() as $result) {
            if ($result['passed'] === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the result of a single test.
     *
     * @param  string  $name
     * @return array
     */
    public function get($name)
    {
        return $this->results[$name];
    }

    /**
     * Get the results of the health check.
     *
     * @return array
     */
    public function results()
    {
        return $this->results;
    }

    /**
     * Return the passed tests.
     *
     * @return array
     */
    public function passed()
    {
        $passed = [];

        foreach ($this->results() as $result) {
            if ($result['passed'] === true) {
                $passed[] = $result;
            }
        }

        return $passed;
    }

    /**
     * Return the failed tests.
     *
     * @return array
     */
    public function failed()
    {
        $failed = [];

        foreach ($this->results() as $result) {
            if ($result['passed'] === false) {
                $failed[] = $result;
            }
        }

        return $failed;
    }
}
