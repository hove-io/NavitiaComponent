<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageStopSchedulesParameters;
use Navitia\Component\Tests\UtilsTestFunction;

/**
 * Description of CoverageStopSchedulesParametersTest
 *
 * @author Johan ROUVE
 */
class CoverageStopSchedulesParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all CoverageStopSchedulesParameters setter
     */
    public function testAllCoverageStopSchedulesParamsSetter()
    {
        $service = new CoverageStopSchedulesParameters();
        $testArray = array(
            'max_stop_date_times' => '20'
        );
        $setter = new UtilsTestFunction();
        $setter->setter($testArray, $service);
    }
}
