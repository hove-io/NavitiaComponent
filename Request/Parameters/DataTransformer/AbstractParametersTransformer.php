<?php

namespace Navitia\Component\Request\Parameters\DataTransformer;

use Navitia\Component\Utils;

/**
 * Description of AbstractParametersTransformer
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class AbstractParametersTransformer implements ParametersTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function transform($request, $params)
    {
        return Utils::setter($request, $params);
    }
}
