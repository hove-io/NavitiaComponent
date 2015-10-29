<?php

namespace Navitia\Component\Request\Parameters;

class JourneysPreferencesParameters
{
    protected $forbidden_uris;
    protected $first_section_mode;
    protected $last_section_mode;
    protected $traveler_type;

    /**
     * @return array
     */
    public function getForbiddenUris()
    {
        return $this->forbidden_uris;
    }

    /**
     * @param array $forbidden_uris
     * @return $this
     */
    public function setForbiddenUris(array $forbidden_uris)
    {
        $this->forbidden_uris = $forbidden_uris;

        return $this;
    }

    /**
     * @return array
     */
    public function getFirstSectionMode()
    {
        return $this->first_section_mode;
    }

    /**
     * @param array $first_section_mode
     * @return $this
     */
    public function setFirstSectionMode(array $first_section_mode)
    {
        $this->first_section_mode = $first_section_mode;

        return $this;
    }

    /**
     * @return array
     */
    public function getLastSectionMode()
    {
        return $this->last_section_mode;
    }

    /**
     * @param array $last_section_mode
     * @return $this
     */
    public function setLastSectionMode(array $last_section_mode)
    {
        $this->last_section_mode = $last_section_mode;

        return $this;
    }

    /**
     * @return array
     */
    public function getTravelerType()
    {
        return $this->traveler_type;
    }

    /**
     * @param array $traveler_type
     * @return $this
     */
    public function setTravelerType(array $traveler_type)
    {
        $this->traveler_type = $traveler_type;

        return $this;

    }
}
