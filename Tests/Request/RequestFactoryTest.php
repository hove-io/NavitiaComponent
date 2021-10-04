<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\RequestFactory;
use PHPUnit\Framework\TestCase;

/**
 * Description of RequestFactoryTest
 *
 * @author rndiaye
 */
class RequestFactoryTest extends TestCase
{
    /**
     * Test for create function
     *
     * @expectedException Navitia\Component\Exception\NavitiaCreationException
     */
    public function testCreate()
    {
        $service = new RequestFactory();
        $service->setDefaultClass('test');
        $service->create(null);
    }
}
