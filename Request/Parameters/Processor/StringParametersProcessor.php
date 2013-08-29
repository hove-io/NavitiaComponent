<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\DataTransformer\StringToParametersTransformer;

/**
 * Description of StringParametersProcessor
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class StringParametersProcessor
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectParameters($request, $params)
    {
        $converter = new StringToParametersTransformer();
        return $converter->transform($request, $params);
    }
}
