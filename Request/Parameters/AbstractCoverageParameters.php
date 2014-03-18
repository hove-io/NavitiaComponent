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
    protected $start_page;
    protected $forbidden_id;

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
}
