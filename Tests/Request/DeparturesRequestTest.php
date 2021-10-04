<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\DeparturesRequest;
use PHPUnit\Framework\TestCase;

/**
 * Description of CoverageRequestTest
 *
 * @author rndiaye
 */
class DeparturesRequestTest extends TestCase
{
    private $service;
    private $path_filter;
    private $parameters;

    protected function setUp()
    {
        $this->service = new DeparturesRequest();
        $this->path_filter = 'lines/line:RAT:M1';
        $this->parameters = '?from_datetime=123312&duration=10';
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
        $value = 'line:RAT:M1';
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
