<?php

namespace Navitia\Component\Request\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of CoveragePlacesNearbyParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoveragePlacesNearbyParameters extends AbstractCoverageParameters
{
    /**
     * @Assert\NotBlank
     */
    protected $uri;

    protected $type;

    protected $distance;

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(array $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
        return $this;
    }
}
