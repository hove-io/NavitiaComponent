<?php

namespace Navitia\Component\Tests\Request\Parameters\Processor;

use Navitia\Component\Request\Parameters\Processor\ArrayParametersProcessor;
use Navitia\Component\Request\Parameters\JourneysParameters;

/**
 * Description of ArrayParametersProcessorTest
 *
 * @author rndiaye
 */
class ArrayParametersProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test ConvertToObjectParameters function
     * the result will be an instance of ParametersInterface
     */
    public function testConvertToObjectParameters()
    {
        $service = new ArrayParametersProcessor();
        // test return object
        $params = array(
            'from' => 'stop_area:TAN:SA:COMM',
            'to' => 'stop_area:SCF:SA:SAOCE87481051',
            'datetime' => '20130819T153000',
            'datetime_represents' => 'departure'
        );
        $request = new JourneysParameters();
        $result = $service->convertToObjectParameters($request, $params);
        $this->assertInstanceOf(
            'Navitia\Component\Request\Parameters\ParametersInterface',
            $result
        );
    }
}
