<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoverageDeparturesParameters;
use Navitia\Component\Tests\UtilsFunctionTest;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class CoverageDeparturesParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all setter/getter
     */
    public function testAllCoverageDeparturesParamsSetter()
    {
        $service = new CoverageDeparturesParameters();
        $testArray = array(
            'nb_stoptimes' => 10
        );
        $setter = new UtilsFunctionTest();
        $setter->testSetter($testArray, $service);
    }
}
