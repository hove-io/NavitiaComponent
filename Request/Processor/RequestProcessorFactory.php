<?php

namespace Navitia\Component\Request\Processor;

use Navitia\Component\AbstractFactory;

/**
 * Description of RequestProcessorFactory
 *
 * @author rndiaye
 */
class RequestProcessorFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('requestProcessor');
    }
}
