<?php

/*
 * JourneysRequest
 */

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\CoverageRequest;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class CoveragaRequestTest extends \PHPUnit_Framework_TestCase
{
    private $service;
    private $filter;
    private $action;
    private $parameters;

    protected function setUp()
    {
        $this->service = new CoverageRequest();
        $this->filter = 'lines/12';
        $this->action = 'route_schedules';
        $this->parameters = '?from_datetime=123312&duration=10';
    }

    /**
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testSetAction()
    {
        $action = array('foo', 'bar');
        $this->service->setAction($action);
    }

    public function testSetFilter()
    {
        $this->service->setFilter($this->filter);
        $filter = $this->service->getFilter();
        $this->assertEquals($filter, $this->filter.'/');
    }

    public function testAddToFilter()
    {
        $type = 'lines';
        $value = '12';
        $this->service->addToFilter($type, $value);
        $filter = $this->service->getFilter();
        $this->assertEquals($filter, $this->filter.'/');
    }

    public function testClearFilter()
    {
        $this->service->clearFilter();
        $filter = $this->service->getFilter();
        $this->assertEquals($filter, null);
    }

    public function testsetParameters()
    {
        $this->service->setParameters($this->parameters);
        $parameters = $this->service->getParameters();
        $this->assertEquals($parameters, $this->parameters);
    }
}
