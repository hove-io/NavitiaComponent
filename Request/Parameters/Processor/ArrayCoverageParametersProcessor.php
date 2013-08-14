<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\DataTransformer\ArrayToCoverageParametersTransformer;

/**
 * Description of ArrayCoverageParametersProcessor
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ArrayCoverageParametersProcessor implements CoverageParametersProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectCoverageParameters($params)
    {
        $converter = new ArrayToCoverageParametersTransformer();
        return $converter->transform($params);
    }
}
