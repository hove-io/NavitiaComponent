<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageParametersFactory;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class CoverageParametersFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $service = new CoverageParametersFactory();
        $this->assertEquals($service->getPrefix(), 'Coverage');
        $this->assertEquals($service->getSuffix(), 'Parameters');
    }
}
