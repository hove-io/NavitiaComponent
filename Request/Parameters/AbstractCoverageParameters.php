<?php

/*
 * AbstractCoverageParameters
 */

namespace Navitia\Component\Request\Parameters;

/**
 * Description of AbstractCoverageParameters
 *
 * @author rndiaye
 */
abstract class AbstractCoverageParameters implements CoverageParametersInterface
{
    protected $from_datetime;
    protected $duration;
    protected $wheelchair;
    protected $depth;

    public function getFromDatetime()
    {
        return $this->from_datetime;
    }

    public function setFromDatetime($from_datetime)
    {
        $this->from_datetime = $from_datetime;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getWheelchair()
    {
        return $this->wheelchair;
    }

    public function setWheelchair($wheelchair)
    {
        $this->wheelchair = $wheelchair;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

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
