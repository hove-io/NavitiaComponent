<?php

namespace Navitia\Component\Request\Parameters\DataTransformer;

use Navitia\Component\Request\Parameters\ParametersInterface;

/**
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
interface ParametersTransformerInterface
{
    /**
     * Fonction permettant de transformer en object Parameters
     *
     * @param mixed $request
     * @param mixed $params
     * @return ParametersInterface
     */
    public function transform($request, $params);
}
