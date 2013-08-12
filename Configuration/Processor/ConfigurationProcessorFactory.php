<?php

/*
 * ConfigurationProcessorFactory
 */

namespace Navitia\Component\Configuration\Processor;

use Navitia\Component\AbstractFactory;

/**
 * Description of ConfigurationProcessorFactory
 *
 * @author rndiaye
 */
class ConfigurationProcessorFactory extends AbstractFactory
{
    public function __construct()
    {
        $this->setSuffix('configurationProcessor');
    }
}
