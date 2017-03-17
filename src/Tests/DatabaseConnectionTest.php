<?php

namespace AndrewDalpino\LaravelHealth\Tests;

use AndrewDalpino\LaravelHealth\Exceptions\InvalidHealthTestException;
use Illuminate\Database\DatabaseManager;

class DatabaseConnectionTest extends BaseTester
{
    /**
     * The database manager.
     *
     * @var  \Illuminate\Database\DatabaseManager  $database
     */
    private $database;

    /**
     * Constructor.
     *
     * @param \Illuminate\Database\DatabaseManager  $database
     * @return void
     */
    public function __construct($database)
    {
        if (! $database instanceof DatabaseManager) {
            throw new InvalidHealthTestException('Missing or invalid database manager.');
        }

        $this->database = $database;
    }

    /**
     * @return boolean
     */
    public function run()
    {
        return $this->database->connection() ? true : false;
    }
}
