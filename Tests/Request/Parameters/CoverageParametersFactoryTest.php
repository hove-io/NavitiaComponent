<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageParametersFactory;
use Navitia\Component\Tests\TestCase;

/**
 * Description of CoverageParametersFactoryTest
 *
 * @author rndiaye
 */
class CoverageParametersFactoryTest extends TestCase
{
    /**
     * Test the CoverageParametersFactory construct
     */
    public function testConstruct()
    {
        $service = new CoverageParametersFactory();
        $this->assertEquals($service->getPrefix(), 'Coverage');
        $this->assertEquals($service->getSuffix(), 'Parameters');
    }
}
