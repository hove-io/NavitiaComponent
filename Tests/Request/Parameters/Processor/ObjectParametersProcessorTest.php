<?php

namespace Navitia\Component\Tests\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\ParametersInterface;
use Navitia\Component\Request\Parameters\Processor\ObjectParametersProcessor;
use Navitia\Component\Request\Parameters\JourneysParameters;
use Navitia\Component\Tests\TestCase;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of ObjectParametersProcessorTest
 *
 * @author rndiaye
 */
class ObjectParametersProcessorTest extends TestCase
{
    public function testConvertToObjectParameters()
    {
        $this->expectException(BadParametersException::class);
        // test return object
        $service = new ObjectParametersProcessor();
        $params = new JourneysParameters();
        $result = $service->convertToObjectParameters('', $params);
        $this->assertInstanceOf(ParametersInterface::class, $result);
        $this->assertEquals($params, $result);

        // test Exception
        $badParams = 'foo';
        $service->convertToObjectParameters('', $badParams);
    }
}
