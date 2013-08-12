<?php

/*
 * ConfigurationTransformerInterface
 */

namespace Navitia\Component\Configuration\DataTransformer;

/**
 *
 * @author rndiaye
 */
interface ConfigurationTransformerInterface
{
    /**
     *
     * @param mixed $config
     * @return NavitiaConfigurationInterface
     */
    public function transform($config);
}
