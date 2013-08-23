<?php

/*
 * ObjectConfigurationProcessor
 */

namespace Navitia\Component\Configuration\Processor;

use Navitia\Component\Configuration\NavitiaConfigurationInterface;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of ObjectRequestProcessor
 *
 * @author rndiaye
 */
class ObjectConfigurationProcessor extends AbstractConfigurationProcessor
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectConfiguration($config)
    {
        if (!($config instanceof NavitiaConfigurationInterface)) {
            throw new BadParametersException(
                sprintf(
                    'The configuration must be an instance of "%s"',
                    'NavitiaConfigurationInterface'
                )
            );
        }
        return $config;
    }
}
