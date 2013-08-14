<?php

namespace Navitia\Component\Request\Parameters\DataTransformer;

use Navitia\Component\Exception\NavitiaCreationException;
use Navitia\Component\Utils;

/**
 * Description of ArrayToConfigurationTransformer
 *
 * @author rndiaye
 */
class StringToCoverageParametersTransformer extends AbstractCoverageParametersTransformer
{
    /**
     * {@inheritDoc}
     */
    public function transform($params)
    {
        $action = explode("?", $params, 2);
        $request = $this->getCoverageParametersClass($action[0]);
        $actionParameters = explode("&", $action[1]);
        foreach ($actionParameters as $parameters) {
            $parameter = explode("=", $parameters);
            $property = Utils::deleteUnderscore($parameter[0]);
            $setter = 'set'.ucfirst($property);
            if (method_exists($request, $setter)) {
                $request->$setter($parameter[1]);
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
}
