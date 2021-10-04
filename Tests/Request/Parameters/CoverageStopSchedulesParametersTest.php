<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageStopSchedulesParameters;
use Navitia\Component\Tests\UtilsTestFunction;
use PHPUnit\Framework\TestCase;

/**
 * Description of CoverageStopSchedulesParametersTest
 *
 * @author Johan ROUVE
 */
class CoverageStopSchedulesParametersTest extends TestCase
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
