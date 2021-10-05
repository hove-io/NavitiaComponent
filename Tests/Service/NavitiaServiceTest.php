<?php

namespace Navitia\Component\Tests\Service;

use Navitia\Component\Service\NavitiaService;
use Navitia\Component\Tests\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Description of NavitiaServiceTest
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class NavitiaServiceTest extends TestCase
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
            'url' => Environment::getNavitiaUrl(),
            'version' => 'v1',
            'token' => Environment::getNavitiaToken()
        );
        $coverage = array(
            'api' => 'coverage',
            'parameters' => array(
                'region' => 'jdr',
                'path_filter' => 'lines/JDR:Bus512',
                'action' => 'route_schedules',
                'parameters' => '?from_datetime=20210927T000000&duration=10'
            )
        );
        $this->service->processConfiguration($config);
        $result = $this->service->process($coverage);
        $this->assertInstanceOf(
            'Symfony\Component\Validator\ConstraintViolationList',
            $result
        );
    }

    /**
     * Test validation
     */
    public function testValidation()
    {
        $config = array(
            'url' => Environment::getNavitiaUrl(),
            'version' => 'v1',
            'token' => Environment::getNavitiaToken()
        );
        $journeys = array(
            'api' => 'journeys',
            'parameters' => array(
                'max_duration' => 0
            )
        );
        $this->service->processConfiguration($config);
        $result = $this->service->process($journeys);
        $this->assertInstanceOf(
            'Symfony\Component\Validator\ConstraintViolationListInterface',
            $result
        );
    }
}
