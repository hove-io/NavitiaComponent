<?php

namespace Navitia\Component\Request\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of CoverageDeparturesParameters
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class CoverageDeparturesParameters extends AbstractCoverageSchedulesParameters
{

    /**
     * Define the freshness of data to use to compute journeys. "'realtime' by default"
     *
     * @Assert\Choice(choices = {"realtime", "base_schedule"})
     *
     * @var string $data_freshness
     */
    protected $data_freshness;

    /**
     * Get data_freshness
     *
     * @return string[]
     */
    public function getDataFreshness()
    {
        return $this->data_freshness;
    }

    /**
     * Set data_freshness
     *
     * @param string $dataFreshness
     *
     * @return self
     */
    public function setDataFreshness($dataFreshness)
    {
        $this->data_freshness = $dataFreshness;

        return $this;
    }
}
