<?php

/*
 * AbstractConfigurationProcessor
 */

namespace Navitia\Component\Configuration\Processor;

use Navitia\Component\Configuration\NavitiaConfigurationInterface;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of AbstractConfigurationProcessor
 *
 * @author rndiaye
 */
abstract class AbstractConfigurationProcessor implements ConfigurationProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function validate(NavitiaConfigurationInterface $config)
    {
        $required = $config::getRequiredProperties();
        foreach ($required as $property => $getter) {
            if (is_null($config->$getter())) {
                throw new BadParametersException(
                    sprintf(
                        'The configuration parameter "%s" is required',
                        $property
                    )
                );
            }
        }
        return true;
    }
}
