<?php

/*
 * ArrayToConfigurationTransformer
 */

namespace Navitia\Component\Configuration\DataTransformer;

use Navitia\Component\Configuration\NavitiaConfiguration;
use Navitia\Component\Exception\BadParametersException;

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
        foreach ($config as $property => $value) {
            $setter = 'set'.ucfirst($property);
            if (method_exists($result, $setter)) {
                $result->$setter($value);
            } else {
                throw new BadParametersException(
                    sprintf(
                        'Neither property "%s" nor method "%s" nor method "%s" exist.',
                        $property,
                        'get'.ucfirst($property),
                        $setter
                    )
                );
            }
        }
        return $result;
    }
}
