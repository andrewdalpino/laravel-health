<?php

namespace AndrewDalpino\LaravelHealth;

class HealthCheckResult
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
    public function __construct(array $results)
    {
        foreach ($results as $result) {
            $this->addResult($result['name'], $result['passed']);
        }
    }

    /**
     * Add a test result to the set.
     *
     * @param  string  $name
     * @param  boolean  $passed
     */
    public function addResult($name, $passed)
    {
        $this->results[] = [
            'name' => (string) $name,
            'passed' => (bool) $passed,
        ];
    }

    /**
     * Did the service pass all the tests?
     *
     * @return boolean
     */
    public function healthy()
    {
        foreach (array_column($this->results, 'passed') as $passed) {
            if ($passed === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Return the failed tests.
     *
     * @return array
     */
    public function getFailed()
    {
        $failed = [];

        foreach ($this->results as $result) {
            if ($result['passed'] === false) {
                $failed[] = $result['name'];
            }
        }

        return $failed;
    }
}
