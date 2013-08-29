<?php

/*
 * AbstractCoverageSchedulesParameters
 */

namespace Navitia\Component\Request\Parameters;

/**
 * Description of AbstractCoverageSchedulesParameters
 *
 * @author rndiaye
 */
abstract class AbstractCoverageSchedulesParameters extends AbstractCoverageParameters
{
    protected $from_datetime;
    protected $duration;
    protected $wheelchair;

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
}
