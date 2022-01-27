<?php

namespace Navitia\Tests\Request;

use Navitia\Component\Exception\BadParametersException;
use Navitia\Component\Request\MetadatasRequest;
use Navitia\Component\Tests\TestCase;

/**
 * Description of MetadatasRequestTest
 *
 * @author rndiaye
 */
class MetadatasRequestTest extends TestCase
{
    public function testAddToPathFilter()
    {
        $this->expectException(BadParametersException::class);

        $service = new MetadatasRequest();
        $service->addtoPathFilter('bar', 'foo');
    }
}
