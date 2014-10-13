<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of StopsSchedulesParameters
 *
 * @copyright (c) 2014, CANALTP
 */
class CoveragePtObjectsParameters extends AbstractCoverageParameters
{
    protected $q;
    protected $type;
    protected $nbmax;
    protected $admin_uri;

    public function getQ()
    {
        return $this->q;
    }

    public function setQ($q)
    {
        $this->q = $q;
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

    public function getNbmax()
    {
        return $this->nbmax;
    }

    public function setNbmax($nbmax)
    {
        $this->nbmax = $nbmax;
        return $this;
    }

    public function getAdminUri()
    {
        return $this->admin_uri;
    }

    public function setAdminUri(array $admin_uri)
    {
        $this->admin_uri = $admin_uri;
        return $this;
    }
}
