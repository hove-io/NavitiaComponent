<?php

namespace Navitia\Component\Tests\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\Processor\ObjectParametersProcessor;
use Navitia\Component\Request\Parameters\JourneysParameters;

/**
 * Description of ObjectParametersProcessorTest
 *
 * @author rndiaye
 */
class ObjectParametersProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test ConvertToObjectParameters function with Exception
     * 
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testConvertToObjectParameters()
    {
        // test return object
        $service = new ObjectParametersProcessor();
        $params = new JourneysParameters();
        $result = $service->convertToObjectParameters('', $params);
        $this->assertInstanceOf(
            'Navitia\Component\Request\Parameters\ParametersInterface',
            $result
        );
        $this->assertEquals($params, $result);

        // test Exception
        $badParams = 'foo';
        $service->convertToObjectParameters('', $badParams);
    }
}
