<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Exception\BadParametersException;
use Navitia\Component\Request\CoverageRequest;
use Navitia\Component\Tests\TestCase;

/**
 * Description of CoverageRequestTest
 *
 * @author rndiaye
 */
class CoverageRequestTest extends TestCase
{
    private CoverageRequest $service;
    private string $pathFilter;
    private string $action;
    private string $parameters;

    protected function setUp(): void
    {
        $this->service = new CoverageRequest();
        $this->pathFilter = 'lines/12';
        $this->action = 'route_schedules';
        $this->parameters = '?from_datetime=123312&duration=10';
    }

    public function testSetAction()
    {
        $this->expectException(BadParametersException::class);

        $this->service->setAction(['foo', 'bar']);
    }

    public function testSetPathFilter(): void
    {
        $this->service->setPathFilter($this->pathFilter);
        $path_filter = $this->service->getPathFilter();
        $this->assertEquals($path_filter, $this->pathFilter.'/');
    }

    public function testAddToPathFilter(): void
    {
        $type = 'lines';
        $value = '12';
        $this->service->addToPathFilter($type, $value);
        $path_filter = $this->service->getPathFilter();
        $this->assertEquals($path_filter, $this->pathFilter.'/');
    }

    public function testClearPathFilter(): void
    {
        $this->service->clearPathFilter();
        $this->assertNull($this->service->getPathFilter());
    }

    public function testSetParameters(): void
    {
        $this->service->setParameters($this->parameters);
        $parameters = $this->service->getParameters();
        $this->assertEquals($parameters, $this->parameters);
    }
}
