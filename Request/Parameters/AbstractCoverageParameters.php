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
abstract class AbstractCoverageParameters extends AbstractParameters
{
    /**
     * @var int used to request navitia using only the base schedules
     */
    const DATA_FRESHNESS_BASE_SCHEDULE = 'base_schedule';

    /**
     * @var int include realtime when available
     */
    const DATA_FRESHNESS_REALTIME = 'realtime';

    protected $count;
    protected $depth;
    protected $start_page;
    protected $forbidden_id;
    protected $calendar;
    protected $start_date;
    protected $end_date;
    protected $show_codes;
    protected $distance;
    protected $data_freshness;

    /**
     * @var bool
     */
    protected $disable_geojson;

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getStartPage()
    {
        return $this->start_page;
    }

    public function setStartPage($startPage)
    {
        $this->start_page = $startPage;
    }

    public function getForbiddenId()
    {
        return $this->forbidden_id;
    }

    public function setForbiddenId($forbidden_id)
    {
        $this->forbidden_id = $forbidden_id;
        return $this;
    }

    public function getCalendar()
    {
        return $this->calendar;
    }

    public function setCalendar($calendar)
    {
        $this->calendar = $calendar;
        return $this;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
        return $this;
    }

    public function getShowCodes()
    {
        return $this->show_codes;
    }

    public function setShowCodes($show_codes)
    {
        $this->show_codes = $show_codes;
        return $this;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
        return $this;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getDataFreshness()
    {
        return $this->data_freshness;
    }

    /**
     * @param mixed $data_freshness
     */
    public function setDataFreshness($data_freshness)
    {
        $this->data_freshness = $data_freshness;
    }

    /**
     * @return bool
     */
    public function isDisableGeoJson()
    {
        return $this->disable_geojson;
    }

    /**
     * @param bool $disable_geojson
     */
    public function setDisableGeoJson($disable_geojson)
    {
        $this->disable_geojson = (bool)$disable_geojson;
    }
}
