<?php

namespace Navitia\Component\Tests\Request\Parameters\DataTransformer;

use Navitia\Component\Request\Parameters\DataTransformer\StringToParametersTransformer;
use Navitia\Component\Request\Parameters\JourneysParameters;
use PHPUnit\Framework\TestCase;

/**
 * Description of StringToParametersTransformerTest
 *
 * @author rndiaye
 */
class StringToParametersTransformerTest extends TestCase
{
    /**
     * Test for transfrom function with Exception
     *
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
