<?php

namespace AndrewDalpino\LaravelHealth\Tests;

use AndrewDalpino\LaravelHealth\Exceptions\InvalidHealthTestException;

class FreeDiskSpaceTest extends BaseTester
{
    const MIN_FREE_SPACE = 10; // In percent.

    /**
     * @return boolean
     */
    public function run()
    {
        $disk = '/';

        $free = round((disk_free_space($disk) /  disk_total_space($disk)) * 100);

        $passed = $free > self::MIN_FREE_SPACE;

        return [
            'value' => $free,
            'passed' => $passed,
        ];
    }
}
