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
     *
     * @dataProvider dataDeleteUnderscore
     */
    public function testDeleteUnderscore($source, $result)
    {
        $params = Utils::deleteUnderscore($source);
        $this->assertEquals($params, $result);
    }

    public function dataDeleteUnderscore()
    {
        return array(
          array('test', 'test'),
          array('test_un', 'testUn'),
          array('test_un_deux', 'testUnDeux')
        );
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
