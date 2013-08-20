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
    public function __construct()
    {
        $this->setAction('metadatas');
    }

    /**
     * addToFilter
     *
     * Fonction permettant d'ajout un filtre
     *
     * @param string $type
     * @param string $value
     * @throws \Exception
     */
    public function addToFilter($type, $value)
    {
        throw new BadParametersException(
            sprintf('The Metadatas API does not need Filter so remove the filter "%s".', $type)
        );
    }
}
