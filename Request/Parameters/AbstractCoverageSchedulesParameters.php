<?php

namespace Navitia\Component\Request\Parameters;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of AbstractCoverageSchedulesParameters
 *
 * @author rndiaye
 */
abstract class AbstractCoverageSchedulesParameters extends AbstractCoverageParameters
{
    /**
     * The date_time from which you want the schedules. Type: iso-date-time.
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     *
     * @var string
     */
    protected $from_datetime;

    /**
     * Maximum duration in seconds between from_datetime and the retrieved datetimes.
     *
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @var integer
     */
    protected $duration;

    /**
     * If true the traveler is considered to be using a wheelchair, thus only accessible public transport are used
     * be warned: many data are currently too faint to provide acceptable answers with this parameter on
     *
     * @Assert\Type(
     *     type="bool",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @var bool
     */
    protected $wheelchair;

    /**
     * Get FromDatetime
     *
     * @return string
     */
    public function getFromDatetime()
    {
        return $this->from_datetime;
    }

    /**
     * Set FromDatetime
     *
     * @return self
     */
    public function setFromDatetime($from_datetime)
    {
        $this->from_datetime = $from_datetime;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set duration
     *
     * @return self
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        
        return $this;
    }

    /**
     * Get wheelchair
     *
     * @return false or true
     */
    public function getWheelchair()
    {
        return $this->wheelchair;
    }

    /**
     * Set wheelchair
     *
     * @return self
     */
    public function setWheelchair($wheelchair)
    {
        $this->wheelchair = $wheelchair;
        
        return $this;
    }
}
