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

    public function testGenerateRequest()
    {
        $request = $this->service->generateRequest($this->api);
        $this->assertInstanceOf(
            'Navitia\Component\Request\CoverageRequest',
            $request
        );

    }
}
