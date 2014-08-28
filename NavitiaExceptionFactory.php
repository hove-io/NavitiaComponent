<?php

namespace Navitia\Component;

use Navitia\Component\FactoryInterface;
use Navitia\Component\Exception\NavitiaException;

class NavitiaExceptionFactory implements FactoryInterface
{
    private $httpCodes;
    private $errorIds;

    public function __construct()
    {
        $this->httpCodes = array(
            400 => 'Navitia\Component\Exception\NavitiaBadRequestException',
            401 => 'Navitia\Component\Exception\NavitiaUnauthorizedException',
            403 => 'Navitia\Component\Exception\NavitiaForbiddenException',
            404 => 'Navitia\Component\Exception\NavitiaNotFoundException',
            0   => 'Navitia\Component\Exception\NavitiaNotRespondingException'
        );
        $this->errorIds = array(
            'date_out_of_bounds' => 'Navitia\Component\Exception\NotFound\DateOutOfBoundsException',
            'no_origin' => 'Navitia\Component\Exception\NotFound\NoOriginException',
            'no_destination' => 'Navitia\Component\Exception\NotFound\NoDestinationException',
            'no_origin_nor_destination' => 'Navitia\Component\Exception\NotFound\NoOriginNorDestinationException',
            'unknown_object' => 'Navitia\Component\Exception\NotFound\UnknownObjectException',
        );
    }

    /**
     * {@inheritDoc}
     */
    public function create($httpCode, $errorId = '', $message = '')
    {
        switch ($httpCode) {
            case 0:
                return new $this->httpCodes[$httpCode](
                    'Navitia timeout',
                    $httpCode
                );
                break;
            case 404:
                return new $this->errorIds[$errorId](
                    'Navitia error message: ' . $message,
                    $httpCode,
                    $errorId
                );
                break;
            case 400:
            case 401:
            case 403:
                return new $this->httpCodes[$httpCode](
                    'Navitia access error',
                    $httpCode
                );
                break;
            default:
                return new NavitiaException(
                    'Navitia error message: ' . $message,
                    $httpCode
                );
        }
    }
}
