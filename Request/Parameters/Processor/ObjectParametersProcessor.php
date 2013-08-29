<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\ParametersInterface;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of ObjectParametersProcessor
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ObjectParametersProcessor implements ParametersProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectParameters($request, $params)
    {
        if (!($params instanceof ParametersInterface)) {
            throw new BadParametersException(
                sprintf(
                    'The parameter must be an instance of "%s"',
                    'ParametersInterface'
                )
            );
        }
        return $params;
    }
}
