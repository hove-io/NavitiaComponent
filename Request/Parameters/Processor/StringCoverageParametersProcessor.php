<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\DataTransformer\StringToCoverageParametersTransformer;

/**
 * Description of StringCoverageParametersProcessor
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class StringCoverageParametersProcessor
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectCoverageParameters($params)
    {
        $converter = new StringToCoverageParametersTransformer();
        return $converter->transform($params);
    }
}
