<?php

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\JourneysRequest;
use Navitia\Component\Tests\Environment;
use Navitia\Component\Tests\TestCase;

/**
 * Description of JourneysRequestTest
 *
 * @author rndiaye
 */
class JourneysRequestTest extends TestCase
{
    private $service;

    protected function setUp(): void
    {
        $this->service = new JourneysRequest();
    }

    /**
     * Test for setParameters function
     */
    public function testSetParameters()
    {
        $params = 'foo';
        $this->service->setParameters($params);
        $result = $this->service->getParameters();
        $this->assertEquals($params, $result);
    }

    /**
     * Test for getApiName Function
     */
    public function testGetApiName()
    {
        $name = $this->service->getApiName();
        $this->assertEquals('journeys', $name);
    }

    /**
     * Test for buildUrl function
     */
    public function testBuildUrl()
    {
        $base = Environment::getNavitiaUrl().'/v1/';
        $this->service->setParameters(
            '?from=stop_area:TAN:SA:COMM'.
            '&to=stop_area:SCF:SA:SAOCE87481051'.
            '&datetime=20130819T153000'.
            '&datetime_represents=departure'
        );
        $url = $this->service->buildUrl($base);
        $result = $base.
            $this->service->getApiName().'?'.
            'from=stop_area%3ATAN%3ASA%3ACOMM&'.
            'to=stop_area%3ASCF%3ASA%3ASAOCE87481051&'.
            'datetime=20130819T153000&'.
            'datetime_represents=departure';
        $this->assertEquals($url, $result);
    }
}
