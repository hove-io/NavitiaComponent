<?php

/*
 * ArrayRequestProcessor
 */

namespace Navitia\Component\Request\Processor;

use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Utils;
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
        $factory = new RequestFactory();
        $request = $factory->create($query['api']);
        if (isset($query['parameters'])) {
            try {
                $request = Utils::setter($request, $query['parameters']);
            } catch (NavitiaCreationException $e) {
                $alias = array('parameters' => $query['parameters']);
                $request = Utils::setter($request, $alias);
            }
        }
        return $request;
    }
}
