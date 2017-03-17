<?php

namespace AndrewDalpino\LaravelHealth\Tests;

use AndrewDalpino\LaravelHealth\Exceptions\InvalidHealthTestException;

class ServerLoadTest extends BaseTester
{
    const MAX_SERVER_LOAD = 95; // In percent.

    /**
     * @return boolean
     */
    public function run()
    {
        $load = intval(sys_getloadavg()[0] * 100);

        $passed = $load <= self::MAX_SERVER_LOAD ? true : false;

        return [
            'value' => $load,
            'passed' => $passed,
        ];
    }
}
