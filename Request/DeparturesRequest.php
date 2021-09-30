<?php

/*
 * DeparturesRequest
 */

namespace Navitia\Component\Request;

/**
 * Description of DeparturesRequest
 */
class DeparturesRequest extends AbstractNavitiaRequest
{
    protected $parameters;

    /**
     * region
     *
     * @var string
     */
    protected $region;

    /**
     * path_filter
     *
     * @var string
     */
    protected $path_filter;

    /**
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * {@inheritDoc}
     */
    public static function getApiName()
    {
        return 'coverage';
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return self
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get Path Filter
     *
     * @return string
     */
    public function getPathFilter()
    {
        return $this->path_filter;
    }

    /**
     * Set Path Filter
     *
     * @param string $path_filter
     *
     * @return self
     */
    public function setPathFilter($path_filter)
    {
        if (empty($path_filter)) {
            $this->clearPathFilter();
        } else {
            $this->path_filter = $path_filter.'/';
        }

        return $this;
    }

    /**
     * Add To Path Filter
     *
     * @param string $type
     * @param string $value
     *
     * @return self
     */
    public function addToPathFilter($type, $value)
    {
        $this->path_filter .= $type.'/'.$value.'/';

        return $this;
    }

    /**
     * Clear Path Filter
     *
     * @return self
     */
    public function clearPathFilter()
    {
        $this->path_filter = null;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function buildUrl($base)
    {
        $url = $base.self::getApiName().'/';
        $parameters = http_build_query($this->getParams());
        $region = $this->getRegion();
        if (!is_null($region)) {
            $url .= $region.'/';
            $path_filter = $this->getPathFilter();
            if (!is_null($path_filter)) {
                $url .= $path_filter;
            }
            if ($parameters !== '') {
                $parameters = preg_replace(
                    '/%5B(?:[0-9]|[1-9][0-9]+)%5D=/',
                    '%5B%5D=',
                    $parameters
                );
                $url .= 'departures?'.$parameters;
            }
        }

        return rtrim($url, '/');
    }
}
