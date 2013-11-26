<?php

namespace Navitia\Component\Test\Request;

use Navitia\Component\Request\MetadatasRequest;

/**
 * Description of MetadatasRequestTest
 *
 * @author rndiaye
 */
class MetadatasRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for addToPathFilter
     *
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testAddToPathFilter()
    {
        $service = new MetadatasRequest();
        $service->addtoPathFilter('bar', 'foo');
    }
}
