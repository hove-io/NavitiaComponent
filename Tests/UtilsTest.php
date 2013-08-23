<?php

namespace Navitia\Component\Tests;

use Navitia\Component\Utils;

/**
 * Description of UtilsTest
 * Test for the Utils Class
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class UtilsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test For deleteUnderscore function
     */
    public function testDeleteUnderscore()
    {
        $params = Utils::deleteUnderscore('datetime_represents');
        $result = 'datetimeRepresents';
        $this->assertEquals($params, $result);
    }

    /**
     * Test For setter Function
     * This Test will have an NavitiaCreationException
     *
     * @expectedException Navitia\Component\Exception\NavitiaCreationException
     */
    public function testSetter()
    {
        Utils::setter(null, 'bar');
    }
}
