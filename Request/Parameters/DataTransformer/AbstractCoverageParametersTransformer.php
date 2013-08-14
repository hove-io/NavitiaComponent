<?php

namespace Navitia\Component\Request\Parameters\DataTransformer;

use Navitia\Component\Request\Parameters\CoverageParametersFactory;
use Navitia\Component\Utils;

/**
 * Description of AbstractCoverageParametersTransformer
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class AbstractCoverageParametersTransformer implements CoverageParametersTransformerInterface
{
    /**
     * {@inheritDoc}
     */
    public function transform($params)
    {
        $request = $this->getCoverageParametersClass($params['name']);
        foreach ($params['parameters'] as $property => $value) {
            $property = Utils::deleteUnderscore($property);
            $setter = 'set'.ucfirst($property);
            if (method_exists($request, $setter)) {
                $request->$setter($value);
            } else {
                throw new NavitiaCreationException(
                    sprintf(
                        'Neither property "%s" nor method "%s" nor method "%s" exist.',
                        $property,
                        'get'.ucfirst($property),
                        $setter
                    )
                );
            }
        }
        return $request;
    }

    /**
     * {@inheritDoc}
     */
    public function getCoverageParametersClass($params)
    {
        $factory = new CoverageParametersFactory();
        $action = Utils::deleteUnderscore($params);
        $request = $factory->create($action);
        return $request;
    }
}
