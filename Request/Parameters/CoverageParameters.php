<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoverageParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageParameters extends AbstractCoverageParameters
{
    protected $filter = null;


    /**
     * @return  string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param   string $filter
     * @return  CoverageParameters
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }
    
}
