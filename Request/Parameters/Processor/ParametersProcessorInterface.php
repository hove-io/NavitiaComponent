<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\ParametersInterface;

/**
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
interface ParametersProcessorInterface
{
    /**
     * Convertit en object ParametersInterface
     * @throws Exception
     * @return ParametersInterface
     */
    public function convertToObjectParameters($request, $params);
}
