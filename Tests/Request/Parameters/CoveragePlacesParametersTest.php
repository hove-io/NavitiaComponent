<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoveragePlacesParameters;
use Navitia\Component\Tests\UtilsTestFunction;

/**
 * Description of CoveragePlacesParametersTest
 *
 * @author rndiaye
 */
class CoveragePlacesParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all CoveragePlaces setter/getter
     */
    public function testAllCoveragePlacesSetter()
    {
        $setter = new UtilsTestFunction();
        $service = new CoveragePlacesParameters();
        $testArray = array(
            'q' => 'place',
            'type' => array('stop_area'),
            'nb_max' => 10,
            'admin_uri' => array('test')
        );
        $setter->setter($testArray, $service);
    }
}
