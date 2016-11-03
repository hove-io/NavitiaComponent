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
    protected $disable_geojson = false;

    public function getMaxStopDateTimes()
    {
        return $this->max_stop_date_times;
    }

    public function setMaxStopDateTimes($max_stop_date_times)
    {
        $this->max_stop_date_times = $max_stop_date_times;
        return $this;
    }

    public function getDisableGeojson()
    {
        return $this->disable_geojson;
    }

    public function setDisableGeojson($disableGeojson)
    {
        $this->disable_geojson = $disableGeojson;
    }
}
