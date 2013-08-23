<?php

namespace Navitia\Component\Tests\Request\Processor;

use Navitia\Component\Request\Processor\ObjectRequestProcessor;
use Navitia\Component\Request\JourneysRequest;

/**
 * Description of ObjectRequestProcessorTest
 *
 * @author rndiaye
 */
class ObjectRequestProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for convertToObjectRequest
     * Will have an BadParametersException Exception
     * 
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testConvertToObjectRequest()
    {
        // test return object
        $service = new ObjectRequestProcessor();
        $request = new JourneysRequest();
        $result = $service->convertToObjectRequest($request);
        $this->assertInstanceOf(
            'Navitia\Component\Request\NavitiaRequestInterface',
            $result
        );
        $this->assertEquals($request, $result);

        // test Exception
        $query = 'foo';
        $service->convertToObjectRequest($query);
    }
}
