<?php

/*
 * ArrayRequestProcessor
 */

namespace Navitia\Component\Request\Processor;

use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Exception\NavitiaCreationException;
use Navitia\Component\Utils;

/**
 * Description of ArrayRequestProcessor
 *
 * @author rndiaye
 */
class ArrayRequestProcessor implements RequestProcessorInterface
{
    /**
     * {@inheritDoc}
     */
    public function convertToObjectRequest($query)
    {
        $factory = new RequestFactory();
        $request = $factory->create($query['api']);
        if (isset($query['parameters'])) {
            foreach ($query['parameters'] as $property => $value) {
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
        }
        return $request;
    }
}
