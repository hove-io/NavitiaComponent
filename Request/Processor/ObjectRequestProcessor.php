<?php

/*
 * ObjectRequestProcessor
 * Validation of Navitia Request
 */

namespace Navitia\Component\Request\Processor;

use Navitia\Component\Request\NavitiaRequestInterface;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of ObjectRequestProcessor
 *
 * @author rndiaye
 */
class ObjectRequestProcessor implements RequestProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectRequest($query)
    {
        if (!($query instanceof NavitiaRequestInterface)) {
            throw new BadParametersException(
                sprintf(
                    'The request must be an instance of "%s"',
                    'NavitiaRequestInterface'
                )
            );
        }
        return $query;
    }
}
