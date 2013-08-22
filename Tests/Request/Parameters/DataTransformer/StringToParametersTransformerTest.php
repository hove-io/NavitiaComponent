<?php

/*
 * JourneysRequest
 */

namespace Navitia\Component\Tests\Request\Parameters\DataTransformer;

use Navitia\Component\Request\Parameters\DataTransformer\StringToParametersTransformer;
use Navitia\Component\Request\Parameters\JourneysParameters;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class StringToParametersTransformerTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * @expectedException Navitia\Component\Exception\NavitiaCreationException
     */
    public function testTransform()
    {
        // test return object
        $service = new StringToParametersTransformer();
        $badParams = '?foo=bar&bar=foo';
        $request = new JourneysParameters();
        $service->transform($request, $badParams);
    }
}
