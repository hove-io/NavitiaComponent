<?php

namespace Navitia\Component\Tests;

use Navitia\Component\Utils;
use Navitia\Component\Exception\NavitiaCreationException;

/**
 * Description of UtilsTest
 * Test for the Utils Class
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class UtilsTest extends TestCase
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
        return [
            ['test', 'test'],
            ['test_un', 'testUn'],
            ['test_un_deux', 'testUnDeux'],
        ];
    }

    public function testSetter()
    {
        $this->expectException(NavitiaCreationException::class);

        Utils::setter(null, 'bar');
    }
}
