<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Tests\TestCase;
use Navitia\Component\Exception\NavitiaCreationException;

/**
 * Description of RequestFactoryTest
 *
 * @author rndiaye
 */
class RequestFactoryTest extends TestCase
{
    public function testCreate()
    {
        $this->expectException(NavitiaCreationException::class);

        $service = new RequestFactory();
        $service->setDefaultClass('test');
        $service->create(null);
    }
}
