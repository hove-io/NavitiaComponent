<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoverageTrafficReportsParameters
 *
 * @copyright (c) 2014, CANALTP
 * @author Vincent Catillon <vincent.catillon@canaltp.fr>
 */
class CoverageTrafficReportsParameters extends AbstractCoverageParameters
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
