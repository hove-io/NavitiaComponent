<?php

namespace Navitia\Component;

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
        $matches = array();
        preg_match('"_[a-z]+"', $param, $matches);
        foreach ($matches as $match) {
            $param = preg_replace('"_[a-z]+"', ucfirst(ltrim($match, '_')), $param);
        }
        return $param;
    }
}
