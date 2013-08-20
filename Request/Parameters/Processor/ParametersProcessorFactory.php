<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\AbstractFactory;

/**
 * Description of ParametersProcessorFactory
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ParametersProcessorFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('ParametersProcessor');
    }
}
