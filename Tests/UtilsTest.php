<?php

namespace Navitia\Component\Tests;

use Navitia\Component\Utils;

/**
 * Description of UtilsTest
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class UtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testDeleteUnderscore()
    {
        $params = Utils::deleteUnderscore('datetime_represents');
        $result = 'datetimeRepresents';
        $this->assertEquals($params, $result);
    }

    /**
     * @expectedException Navitia\Component\Exception\NavitiaCreationException
     */
    public function testSetter()
    {
        Utils::setter(null, 'bar');
    }
}
