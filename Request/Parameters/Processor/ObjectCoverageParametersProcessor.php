<?php

namespace Navitia\Component\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\CoverageParametersInterface;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of ObjectCoverageParametersProcessor
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ObjectCoverageParametersProcessor implements CoverageParametersProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectCoverageParameters($params)
    {
        if (!($params instanceof CoverageParametersInterface)) {
            throw new BadParametersException(
                sprintf(
                    '"%s" must be an instance of "%s"',
                    get_class($params),
                    'CoverageParametersInterface'
                )
            );
        }
        return $params;
    }
}
