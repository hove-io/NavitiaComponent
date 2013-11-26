<?php

/*
 * MetadatasRequest
 */

namespace Navitia\Component\Request;

use Navitia\Component\Exception\BadParametersException;

/**
 * Description of MetadatasRequest
 *
 * @author rndiaye
 */
class MetadatasRequest extends CoverageRequest
{
    /**
     * addToPathFilter
     *
     * Fonction permettant d'ajout un filtre
     *
     * @param string $type
     * @param string $value
     * @throws \Exception
     */
    public function addToPathFilter($type, $value)
    {
        throw new BadParametersException(
            sprintf(
                'The Metadatas API does not need path_filter'.
                'so remove the path_filter "%s".',
                $type
            )
        );
    }
}
