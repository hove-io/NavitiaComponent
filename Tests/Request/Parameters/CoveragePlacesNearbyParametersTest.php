<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoveragePlacesNearbyParameters;
use Navitia\Component\Tests\UtilsTestFunction;

/**
 * Description of CoveragePlacesNearbyParametersTest
 *
 * @author Johan ROUVE
 */
class CoveragePlacesNearbyParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all CoveragePlacesNearbyParameters setter
     */
    public function testAllCoveragePlacesNearbyParamsSetter()
    {
        $service = new CoveragePlacesNearbyParameters();
        $testArray = array(
            'type' => array('stop_area'),
            'distance' => '1000'
        );
        $setter = new UtilsTestFunction();
        $setter->setter($testArray, $service);
    }
}
