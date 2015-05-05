<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoverageRouteSchedulesParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageRouteSchedulesParameters extends AbstractCoverageSchedulesParameters
{
    protected $max_date_times;

	public function getMaxDateTimes()
    {
        return $this->max_date_times;
    }

    public function setMaxDateTimes($max_date_times)
    {
        $this->max_date_times = $max_date_times;
    }
}
