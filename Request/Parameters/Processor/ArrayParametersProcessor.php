<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\DataTransformer\ArrayToParametersTransformer;

/**
 * Description of ArrayParametersProcessor
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ArrayParametersProcessor implements ParametersProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectParameters($request, $params)
    {
        $converter = new ArrayToParametersTransformer();
        return $converter->transform($request, $params);
    }
}
