<?php

/*
 * JourneysRequest
 */

namespace Navitia\Component\Tests\Request;

use Navitia\Component\Request\JourneysRequest;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class JourneysRequestTest extends \PHPUnit_Framework_TestCase
{
    private $service;

    protected function setUp()
    {
        $this->service = new JourneysRequest();
    }

    public function testSetParameters()
    {
        $params = 'foo';
        $this->service->setParameters($params);
        $result = $this->service->getParameters();
        $this->assertEquals($params, $result);
    }

    public function testGetApiName()
    {
        $name = $this->service->getApiName();
        $this->assertEquals('journeys', $name);
    }

    public function testBuildUrl()
    {
        $base = 'http://navitia2-ws.ctp.dev.canaltp.fr/v1/';
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
