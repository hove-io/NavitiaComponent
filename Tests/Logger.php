<?php

namespace Navitia\Component\Tests;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
    /**
     * Logs with an arbitrary return.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        return 'test';
    }
}
