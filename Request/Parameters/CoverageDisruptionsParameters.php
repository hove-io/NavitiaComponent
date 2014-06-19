<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoverageDisruptionsParameters
 *
 * @copyright (c) 2014, CANALTP
 * @author rndiaye
 */
class CoverageDisruptionsParameters extends AbstractCoverageParameters
{
    protected $datetime;
    protected $period;

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setPeriod($period)
    {
        $this->period = $period;
    }
}
