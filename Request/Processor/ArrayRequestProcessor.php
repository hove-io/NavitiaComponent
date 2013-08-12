<?php

/*
 * ArrayRequestProcessor
 */

namespace Navitia\Component\Request\Processor;

use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Exception\NavitiaCreationException;

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
        $matches = array();
        $factory = new RequestFactory();
        $request = $factory->create($query['api']);
        if (isset($query['parameters'])) {
            foreach ($query['parameters'] as $property => $value) {
                preg_match('"_[a-z]+"', $property, $matches);
                foreach ($matches as $match) {
                    $property = preg_replace('"_[a-z]+"', ucfirst(ltrim($match, '_')), $property);
                }
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
