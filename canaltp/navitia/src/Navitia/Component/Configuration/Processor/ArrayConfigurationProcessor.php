<?php

/*
 * ArrayConfigurationProcessor
 */

namespace Navitia\Component\Configuration\Processor;

use Navitia\Component\Configuration\DataTransformer\ArrayToConfigurationTransformer;

/**
 * Description of ArrayConfigurationProcessor
 *
 * @author rndiaye
 */
class ArrayConfigurationProcessor extends AbstractConfigurationProcessor
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectConfiguration($config)
    {
        $converter = new ArrayToConfigurationTransformer();
        return $converter->transform($config);
    }
}
