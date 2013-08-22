<?php

/*
 * MetadatasRequest
 */

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
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testAddToFilter()
    {
        $service = new MetadatasRequest();
        $service->addtoFilter('bar', 'foo');
    }
}
