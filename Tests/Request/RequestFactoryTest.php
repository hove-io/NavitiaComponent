<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\RequestFactory;

/**
 * Description of RequestFactoryTest
 *
 * @author rndiaye
 */
class RequestFactoryTest extends \PHPUnit_Framework_TestCase
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
