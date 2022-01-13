<?php

namespace Navitia\Component\Tests\Request\Processor;

use Navitia\Component\Request\NavitiaRequestInterface;
use Navitia\Component\Request\Processor\ObjectRequestProcessor;
use Navitia\Component\Request\JourneysRequest;
use Navitia\Component\Tests\TestCase;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of ObjectRequestProcessorTest
 *
 * @author rndiaye
 */
class ObjectRequestProcessorTest extends TestCase
{
    /**
     * Test for convertToObjectRequest
     * Will have an BadParametersException Exception
     */
    public function testConvertToObjectRequest()
    {
        $this->expectException(BadParametersException::class);

        // test return object
        $service = new ObjectRequestProcessor();
        $request = new JourneysRequest();
        $result = $service->convertToObjectRequest($request);
        $this->assertInstanceOf(NavitiaRequestInterface::class, $result);
        $this->assertEquals($request, $result);

        // test Exception
        $query = 'foo';
        $service->convertToObjectRequest($query);
    }
}
