<?php

/*
 * AbstractNavitiaRequest
 */

namespace Navitia\Component\Request;

/**
 * Description of AbstractNavitiaRequest
 *
 * @author rndiaye
 */
abstract class AbstractNavitiaRequest implements NavitiaRequestInterface
{
    /**
     * BuildUrl
     *
     * @param string $base
     * @return string
     */
    public function buildUrl($base)
    {
        $url = $base.$this::getApiName();
        $parameters = http_build_query($this->getParams());
        if (!empty($parameters)) {
            $parameters = preg_replace(
                '/%5B(?:[0-9]|[1-9][0-9]+)%5D=/',
                '%5B%5D=',
                $parameters
            );

            $url .= '?'.$parameters;
        }
        return $url;
    }

    /**
     * getParams
     *
     * @return array
     */
    public function getParams()
    {
        $properties = get_object_vars($this);
        $params = array();
        foreach ($properties as $name => $value) {
            if (!is_null($value)) {
                $params[$name] = $value;
            }
        }
        return $params;
    }
}
