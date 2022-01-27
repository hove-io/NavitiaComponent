<?php

namespace Navitia\Component\Tests;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    public function __construct(protected string $name)
    {
    }

    public function log($level, $message, array $context = [])
    {
        return 'test';
    }
}
