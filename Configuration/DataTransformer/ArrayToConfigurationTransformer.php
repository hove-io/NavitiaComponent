<?php

/*
 * ArrayToConfigurationTransformer
 */

namespace Navitia\Component\Configuration\DataTransformer;

use Navitia\Component\Configuration\NavitiaConfiguration;
use Navitia\Component\Utils;

/**
 * Description of ArrayToConfigurationTransformer
 *
 * @author rndiaye
 */
class ArrayToConfigurationTransformer implements ConfigurationTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function transform($config)
    {
        $result = new NavitiaConfiguration();
        return Utils::setter($result, $config);
    }
}
