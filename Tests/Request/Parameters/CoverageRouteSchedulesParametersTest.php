<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageRouteSchedulesParameters;
use Navitia\Component\Tests\UtilsFunctionTest;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class CoverageRouteSchedulesParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all setter/getter
     */
    public function testAllCoverageParamsSetter()
    {
        $service = new CoverageRouteSchedulesParameters();
        $testArray = array(
            'from_datetime' => '20130819T153000',
            'duration' => 20,
            'wheelchair' => true,
        );
        $setter = new UtilsFunctionTest();
        $setter->testSetter($testArray, $service);
    }
}
