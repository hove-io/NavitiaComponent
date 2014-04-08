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
    protected $count;
    protected $depth;
    protected $calendar;
    protected $startPage;
    protected $startDate;
    protected $endDate;

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
        return $this->startPage;
    }

    public function setStartPage($startPage)
    {
        $this->startPage = $startPage;
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
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }
}
