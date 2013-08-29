<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageDeparturesParameters;
use Navitia\Component\Tests\UtilsTestFunction;

/**
 * Description of CoverageDeparturesParametersTest
 *
 * @author rndiaye
 */
class CoverageDeparturesParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all CoverageDepartures setter/getter
     */
    public function testAllCoverageDeparturesParamsSetter()
    {
        $service = new CoverageDeparturesParameters();
        $testArray = array(
            'nb_stoptimes' => 10
        );
        $setter = new UtilsTestFunction();
        $setter->setter($testArray, $service);
    }
}
