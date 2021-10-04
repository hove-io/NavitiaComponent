<?php

namespace Navitia\Tests\Request;

use Navitia\Component\Request\MetadatasRequest;
use PHPUnit\Framework\TestCase;

/**
 * Description of MetadatasRequestTest
 *
 * @author rndiaye
 */
class MetadatasRequestTest extends TestCase
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
