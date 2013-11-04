<?php

namespace Navitia\Component;

use Navitia\Component\Exception\NavitiaCreationException;

/**
 * Description of Utils
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class Utils
{
    /**
     * Fonction permettant de supprimer les underscores
     *
     * @param string $param
     * @return string
     */
    public static function deleteUnderscore($param)
    {
        $parts = explode('_', $param);
        $result = array_shift($parts);
        foreach ($parts as $part) {
            $result .= ucfirst($part);
        }
        return $result;
    }

    /**
     * Fonction permettant de setter
     * @param object $request
     * @param array $params
     * @return object
     * @throws NavitiaCreationException
     */
    public static function setter($request, $params)
    {
        if (is_array($params)) {
            foreach ($params as $property => $value) {
                $property = Utils::deleteUnderscore($property);
                $setter = 'set'.ucfirst($property);
                if (method_exists($request, $setter)) {
                    $request->$setter($value);
                } else {
                    throw new NavitiaCreationException(
                        sprintf(
                            'Neither property "%s" nor method "%s"'.
                            'nor method "%s" exist.',
                            $property,
                            'get'.ucfirst($property),
                            $setter
                        )
                    );
                }
            }
        } else {
            throw new NavitiaCreationException(
                sprintf(
                    'The parameter (type "%s") will be an Array',
                    gettype($params)
                )
            );
        }
        return $request;
    }
}
