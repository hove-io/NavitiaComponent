<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\CoverageParametersInterface;

/**
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
interface CoverageParametersProcessorInterface
{
    /**
     * Convertit en object CoverageParametersInterface
     * @throws Exception
     * @return CoverageParametersInterface
     */
    public function convertToObjectCoverageParameters($params);
}
