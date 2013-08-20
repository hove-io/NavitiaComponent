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
    protected $startPage;

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
}
