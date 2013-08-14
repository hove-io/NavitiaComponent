<?php

namespace Navitia\Component\Request\Parameters\DataTransformer;

use Navitia\Component\Request\Parameters\CoverageParametersInterface;

/**
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
interface CoverageParametersTransformerInterface
{
    /**
     * Fonction permettant de transformer en obejct CoverageParameters
     *
     * @param mixed $params
     * @return CoverageParametersInterface
     */
    public function transform($params);

    /**
     * Fonction permettant de recuperer la class de l'action avec le factory
     *
     * @param mixed $params
     * @return CoverageParametersInterface
     */
    public function getCoverageParametersClass($params);
}
