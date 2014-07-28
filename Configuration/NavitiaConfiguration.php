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

    /**
     *
     * @var string
     */
    private $format = 'object';

    /**
     * Token for authentication
     * @var string
     */
    private $token;

    /**Resposne error type
     *
     * @var string
     */
    private $response_error;

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
     * Returns the Token of navitia configuration.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the Token of navitia configuration
     *
     * @param string $token
     * @return \Navitia\Component\Configuration\NavitiaConfiguration
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get the error response type
     * @return string
     */
    public function getResponseError()
    {
        return $this->response_error;
    }

    /**
     * Set Error Response Type
     * @param string $response_error
     * @return \Navitia\Component\Configuration\NavitiaConfiguration
     */
    public function setResponseError($response_error)
    {
        $this->response_error = $response_error;
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
            'format' => 'getFormat',
            'response_error' => 'getResponseError'
        );
    }
}
