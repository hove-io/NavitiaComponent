<?php

namespace Navitia\Component\Exception\NotFound;

use Navitia\Component\Exception\NavitiaNotFoundException;
use Navitia\Component\Exception\ExceptionInterface;

class UnknownObjectException extends NavitiaNotFoundException implements ExceptionInterface
{
}