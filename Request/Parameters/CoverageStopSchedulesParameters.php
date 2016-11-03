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

    /**
     * @var bool
     */
    protected $disable_geojson;

    public function getMaxStopDateTimes()
    {
        return $this->max_stop_date_times;
    }

    public function setMaxStopDateTimes($max_stop_date_times)
    {
        $this->max_stop_date_times = $max_stop_date_times;
        return $this;
    }

    /**
     * @return bool
     */
    public function getDisableGeojson()
    {
        return $this->disable_geojson;
    }

    /**
     * @param bool $disableGeojson
     */
    public function setDisableGeojson($disableGeojson)
    {
        $this->disable_geojson = $disableGeojson;
    }
}
