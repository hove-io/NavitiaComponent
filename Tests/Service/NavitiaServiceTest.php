<?php

namespace Navitia\Component\Tests\Service;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use Navitia\Component\Request\CoverageRequest;
use Navitia\Component\Service\NavitiaService;
use Navitia\Component\Tests\Environment;
use Navitia\Component\Tests\TestCase;

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

    protected function setUp(): void
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
        $this->assertInstanceOf(CoverageRequest::class, $request);
    }

    /**
     * Test for callApi function
     */
    public function testCallApi()
    {
        $config = [
            'url' => Environment::getNavitiaUrl(),
            'version' => 'v1',
            'token' => Environment::getNavitiaToken(),
        ];
        $coverage = [
            'api' => 'coverage',
            'parameters' => [
                'region' => 'jdr',
                'path_filter' => 'lines/JDR:Bus512',
                'action' => 'route_schedules',
                'parameters' => '?from_datetime=20210927T000000&duration=10',
            ],
        ];
        $this->service->processConfiguration($config);
        $result = $this->service->process($coverage);
        $this->assertInstanceOf(ConstraintViolationList::class, $result);
    }

    /**
     * Test validation
     */
    public function testValidation()
    {
        $config = [
            'url' => Environment::getNavitiaUrl(),
            'version' => 'v1',
            'token' => Environment::getNavitiaToken(),
        ];
        $journeys = [
            'api' => 'journeys',
            'parameters' => [
                'max_duration' => 0,
            ],
        ];
        $this->service->processConfiguration($config);
        $result = $this->service->process($journeys);
        $this->assertInstanceOf(ConstraintViolationListInterface::class, $result);
    }
}
