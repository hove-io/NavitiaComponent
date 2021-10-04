<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageParameters;
use Navitia\Component\Tests\UtilsTestFunction;
use PHPUnit\Framework\TestCase;

/**
 * Description of CoverageParametersTest
 *
 * @author rndiaye
 */
class CoverageParametersTest extends TestCase
{
    /**
     * This function is used to test all Generic Coverage setter/getter
     */
    public function testAllCoverageParamsSetter()
    {
        $service = new CoverageParameters();
        $testArray = array(
            'count' => 10,
            'depth' => null,
            'start_page' => 2
        );
        $setter = new UtilsTestFunction();
        $setter->setter($testArray, $service);
    }
}
