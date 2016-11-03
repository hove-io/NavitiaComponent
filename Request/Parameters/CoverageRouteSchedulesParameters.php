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

    /**
     * @var bool
     */
    protected $disable_geojson;

    public function getMaxDateTimes()
    {
        return $this->max_date_times;
    }

    public function setMaxDateTimes($max_date_times)
    {
        $this->max_date_times = $max_date_times;
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
