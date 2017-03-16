<?php

namespace AndrewDalpino\LaravelHealth\Exceptions;

use Exception;

class InvalidHealthTestException extends Exception
{
    /**
     * Constructor.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        return parent::__construct($message);
    }
}
