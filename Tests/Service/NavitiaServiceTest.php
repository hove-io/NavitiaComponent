<?php

namespace Navitia\Component\Tests\Service;

use Navitia\Component\Service\NavitiaService;

/**
 * Description of NavitiaServiceTest
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class NavitiaServiceTest extends \PHPUnit_Framework_TestCase
{
    private $api;
    private $service;

    protected function setUp()
    {
        $this->api = 'coverage';
        $this->service = new NavitiaService();
    }

    /**
     * Test for generateRequest Function
     * This request will be an instance of CoverageRequest
     */
    public function testGenerateRequest()
    {
        $request = $this->service->generateRequest($this->api);
        $this->assertInstanceOf(
            'Navitia\Component\Request\CoverageRequest',
            $request
        );

    }

    /**
     * Test for callApi function
     */
    public function testCallApi()
    {
        $config = array(
            'url' => 'http://navitia2-ws.ctp.dev.canaltp.fr',
            'version' => 'v1'
        );
        $coverage = array(
            'api' => 'coverage',
            'parameters' => array(
                'region' => 'centre',
                'filter' => 'lines/12',
                'action' => 'route_schedules',
                'parameters' => '?from_datetime=123312&duration=10'
            )
        );
        $this->service->processConfiguration($config);
        $this->service->process($coverage);
    }
}
