<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoveragePlacesNearbyParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoveragePlacesNearbyParameters extends AbstractCoverageParameters
{
    protected $type;
    protected $distance;

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
