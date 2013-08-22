<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageParameters;
use Navitia\Component\Tests\UtilsFunctionTest;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class CoverageParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all setter/getter
     */
    public function testAllCoverageParamsSetter()
    {
        $service = new CoverageParameters();
        $testArray = array(
            'count' => 10,
            'depth' => null,
            'start_page' => 2
        );
        $setter = new UtilsFunctionTest();
        $setter->testSetter($testArray, $service);
    }
}
