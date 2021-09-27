<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageRouteSchedulesParameters;
use Navitia\Component\Tests\UtilsTestFunction;
use PHPUnit\Framework\TestCase;

/**
 * Description of CoverageRouteSchedulesParametersTest
 *
 * @author rndiaye
 */
class CoverageRouteSchedulesParametersTest extends TestCase
{
    /**
     * This function is used to test all CoverageSchedules setter/getter
     */
    public function testAllCoverageSchedulesParamsSetter()
    {
        $service = new CoverageRouteSchedulesParameters();
        $testArray = array(
            'from_datetime' => '20130819T153000',
            'duration' => 20,
            'wheelchair' => true,
        );
        $setter = new UtilsTestFunction();
        $setter->setter($testArray, $service);
    }
}
