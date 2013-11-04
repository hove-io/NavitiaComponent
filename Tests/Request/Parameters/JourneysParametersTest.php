<?php

namespace Navitia\Component\Tests\Request\Parameters;

use Navitia\Component\Request\Parameters\JourneysParameters;
use Navitia\Component\Tests\UtilsTestFunction;

/**
 * Description of JourneysParametersTest
 *
 * @author rndiaye
 */
class JourneysParametersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This function is used to test all Journeys setter/getter
     */
    public function testAllJourneysSetter()
    {
        $setter = new UtilsTestFunction();
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
            'wheelchair' => true,
            'type' => 'comfort, rapid',
            'count' => 10
        );
        $setter->setter($testArray, $service);
    }
}
