<?php

/*
 * NavitiaConfigurationProcessor
 * Validation of Navitia Configuration
 */

namespace Navitia\Component\Configuration\Processor;

use Navitia\Component\Configuration\NavitiaConfigurationInterface;

/**
 * Description of NavitiaConfigurationProcessor
 *
 * @author rndiaye
 */
interface ConfigurationProcessorInterface
{
    /**
     * Convertit en object NavitiaConfigurationInterface
     * @throws Exception
     * @return NavitiaConfigurationInterface
     */
    public function convertToObjectConfiguration($config);

    /**
     * Validation des paramètres obligatoires
     * @throws Exception
     * @return Booleen
     */
    public function validate(NavitiaConfigurationInterface $config);
}
