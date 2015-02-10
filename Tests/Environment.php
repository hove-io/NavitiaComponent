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
     * Return the NAVITIA_TOKEN environment variable defined
     * @throws Navitia\Component\Exception\NavitiaBadRequestException
     */
    public static function getNavitiaToken()
    {
        $navitiaToken = getenv('NAVITIA_TOKEN');
        if ($navitiaToken === false) {
            throw new NavitiaBadRequestException(
                'The environment variable "NAVITIA_TOKEN" is required.'
            );
        }
        return $navitiaToken;
    }
}
