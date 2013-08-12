<?php

/*
 * NavitiaConfiguration
 * All Configuration for Navitia
 */

namespace Navitia\Component\Configuration;

/**
 * Description of NavitiaConfiguration
 *
 * @author rndiaye
 */
class NavitiaConfiguration implements NavitiaConfigurationInterface
{
    /**
     *
     * @var string
     */
    private $url;

    /**
     *
     * @var string
     */
    private $version = 'v1';

    private $format = 'object';

    /**
     * Returns the Url of navitia configuration.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the Url of navitia configuration
     *
     * @param string $url
     * @return \Navitia\Component\Configuration\NavitiaConfiguration
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }


    /**
     * Returns the Version of navitia configuration
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version of navitia configuration
     *
     * @param string $version
     * @return \Navitia\Component\Configuration\NavitiaConfiguration
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get the format of navitia response
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the format of navitia response
     *
     * @param string $format
     * @return \Navitia\Component\Configuration\NavitiaConfiguration
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public static function getRequiredProperties()
    {
        return array(
            'url' => 'getUrl',
            'version' => 'getVersion',
            'format' => 'getFormat'
        );
    }
}
