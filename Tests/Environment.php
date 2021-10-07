<?php

namespace Navitia\Component\Tests;

use Navitia\Component\Exception\NavitiaBadRequestException;

/**
 * Description of Environment
 * @author Vincent Catillon <vincent.catillon@canaltp.fr>
 */
class Environment
{
    /**
     * Return the NAVITIA TOKEN
     */
    public static function getNavitiaToken()
    {
        return 'token';
    }
    
    /**
     * Return the NAVITIA URL
     */
    public static function getNavitiaUrl()
    {
        return 'http://mock_navitia:1080';
    }

    /**
     * Return the NAVITIA COVERAGE
     */
    public static function getNavitiaCoverage()
    {
        return 'jdr';
    }
}
