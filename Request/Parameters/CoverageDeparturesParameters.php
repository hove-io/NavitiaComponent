<?php

namespace Navitia\Component\Request\Parameters;

/**
 * Description of CoverageDeparturesParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageDeparturesParameters extends AbstractCoverageSchedulesParameters
{
    protected $nb_stoptimes;

    /**
     * Getter de nb_stoptimes
     *
     * @return integer
     */
    public function getNbStoptimes()
    {
        return $this->nb_stoptimes;
    }

    /**
     * Setter de nb_stoptimes
     *
     * @param integrer $nb_stoptimes
     */
    public function setNbStoptimes($nb_stoptimes)
    {
        $this->nb_stoptimes = $nb_stoptimes;
    }
}
