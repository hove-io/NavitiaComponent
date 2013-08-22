<?php

/*
 * JourneysRequest
 */

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\RequestFactory;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class RequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Navitia\Component\Exception\NavitiaCreationException
     */
    public function testCreate()
    {
        $service = new RequestFactory();
        $service->setDefaultClass(null);
        $service->create(null);
    }
}
