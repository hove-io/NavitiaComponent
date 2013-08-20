<?php

/*
 * JourneysRequest
 */

namespace Navitia\Component\Request;

/**
 * Description of JourneysRequest
 *
 * @author rndiaye
 */
class JourneysRequest extends AbstractNavitiaRequest
{
    protected $parameters;

    /**
     * Getter des parameters de l'appel
     *
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Setter des parameters
     *
     * @param string $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * {@inheritDoc}
     */
    public static function getApiName()
    {
        return 'journeys';
    }
}
