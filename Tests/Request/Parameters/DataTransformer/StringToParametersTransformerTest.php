<?php

namespace Navitia\Component\Tests\Request\Parameters\DataTransformer;

use Navitia\Component\Request\Parameters\DataTransformer\StringToParametersTransformer;
use Navitia\Component\Request\Parameters\JourneysParameters;
use Navitia\Component\Tests\TestCase;
use Navitia\Component\Exception\NavitiaCreationException;

/**
 * Description of StringToParametersTransformerTest
 *
 * @author rndiaye
 */
class StringToParametersTransformerTest extends TestCase
{
    public function testTransform()
    {
        $this->expectException(NavitiaCreationException::class);
        // test return object
        $service = new StringToParametersTransformer();
        $badParams = '?foo=bar&bar=foo';
        $request = new JourneysParameters();
        $service->transform($request, $badParams);
    }
}
