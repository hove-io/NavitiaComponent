<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\CoveragePtObjectsParameters;
use Navitia\Component\Tests\UtilsTestFunction;
use Navitia\Component\Tests\TestCase;

/**
 * Description of CoveragePtObjectsParametersTest
 *
 */
class CoveragePtObjectsParametersTest extends TestCase
{
    /**
     * This function is used to test all CoveragePtObjects setter/getter
     */
    public function testAllCoveragePtObjectsSetter()
    {
        $setter = new UtilsTestFunction();
        $service = new CoveragePtObjectsParameters();
        $testArray = array(
            'q' => 'ptobject',
            'type' => array('network'),
            'nb_max' => 10,
            'admin_uri' => array('test')
        );
        $setter->setter($testArray, $service);
    }
}
