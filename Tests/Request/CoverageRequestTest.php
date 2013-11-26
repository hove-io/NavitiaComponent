<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\CoverageRequest;

/**
 * Description of CoveragaRequestTest
 *
 * @author rndiaye
 */
class CoveragaRequestTest extends \PHPUnit_Framework_TestCase
{
    private $service;
    private $path_filter;
    private $action;
    private $parameters;

    protected function setUp()
    {
        $this->service = new CoverageRequest();
        $this->path_filter = 'lines/12';
        $this->action = 'route_schedules';
        $this->parameters = '?from_datetime=123312&duration=10';
    }

    /**
     * Test for setAction
     * Will have a BadParametersException Exception
     *
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testSetAction()
    {
        $action = array('foo', 'bar');
        $this->service->setAction($action);
    }

    /**
     * Test for setPathFilter function
     */
    public function testSetPathFilter()
    {
        $this->service->setPathFilter($this->path_filter);
        $path_filter = $this->service->getPathFilter();
        $this->assertEquals($path_filter, $this->path_filter.'/');
    }

    /**
     * Test for addToPathFilter function
     */
    public function testAddToPathFilter()
    {
        $type = 'lines';
        $value = '12';
        $this->service->addToPathFilter($type, $value);
        $path_filter = $this->service->getPathFilter();
        $this->assertEquals($path_filter, $this->path_filter.'/');
    }

    /**
     * Test for clearPathFilter function
     */
    public function testClearPathFilter()
    {
        $this->service->clearPathFilter();
        $path_filter = $this->service->getPathFilter();
        $this->assertEquals($path_filter, null);
    }

    /**
     * Test for setParameters function
     */
    public function testSetParameters()
    {
        $this->service->setParameters($this->parameters);
        $parameters = $this->service->getParameters();
        $this->assertEquals($parameters, $this->parameters);
    }
}
