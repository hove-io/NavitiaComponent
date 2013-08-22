<?php

/*
 * JourneysRequest
 */

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\JourneysParameters;
use Navitia\Component\Tests\UtilsFunctionTest;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class JourneysParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all setter/getter
     */
    public function testAllJourneysSetter()
    {
        $setter = new UtilsFunctionTest();
        $service = new JourneysParameters();
        $testArray = array(
            'from' => 'stop_area:TAN:SA:COMM',
            'to' => 'stop_area:SCF:SA:SAOCE87481051',
            'datetime' => '20130819T153000',
            'datetime_represents' => 'departure',
            'max_duration' => 10,
            'walking_speed' => 10,
            'bike_speed' => 10,
            'car_speed' => 10,
            'departure_mode' => 'bike',
            'arrival_mode' => 'car',
            'forbidden_uris' => 'plane',
            'walking_distance' => 10,
            'bike_distance' => 100,
            'car_distance' => 100,
            'wheelchair' => true
        );
        $setter->testSetter($testArray, $service);
    }
}
