<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\AbstractFactory;

/**
 * Description of CoverageParametersProcessorFactory
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageParametersProcessorFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('CoverageParametersProcessor');
    }
}
