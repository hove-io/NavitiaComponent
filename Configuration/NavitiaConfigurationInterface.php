<?php

/**
 * NavitiaConfigurationInterface
 */

namespace Navitia\Component\Configuration;

/**
 * Description of NavitiaConfigurationInterface
 *
 * @author rndiaye
 */
interface NavitiaConfigurationInterface
{
    /**
     * Renvoie la liste des paramètres obligatoires
     * @return array
     */
    public static function getRequiredProperties();
}
