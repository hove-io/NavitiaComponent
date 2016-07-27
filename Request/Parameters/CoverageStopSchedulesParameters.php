<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoverageStopSchedulesParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageStopSchedulesParameters extends AbstractCoverageSchedulesParameters
{
    protected $max_stop_date_times;
    protected $data_freshness;

    public function getMaxStopDateTimes()
    {
        return $this->max_stop_date_times;
    }

    public function setMaxStopDateTimes($max_stop_date_times)
    {
        $this->max_stop_date_times = $max_stop_date_times;
        return $this;
    }

    public function getDataFreshness()
    {
        return $this->data_freshness;
    }

    public function setDataFreshness($data_freshness)
    {
        $this->data_freshness = $data_freshness;
        return $this;
    }
}
