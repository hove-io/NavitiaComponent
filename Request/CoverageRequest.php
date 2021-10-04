<?php

/**
 * CoverageRequest
 */

namespace Navitia\Component\Request;

use Navitia\Component\Request\Parameters\ParametersFactory;
use Navitia\Component\Exception\BadParametersException;
use Navitia\Component\Utils;

/**
 * Description of CoverageRequest
 *
 * @author rndiaye
 */
class CoverageRequest extends AbstractNavitiaRequest
{
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
     * action
     *
     * @var mixed
     */
    protected $action;

    /**
     * parameters de l'action
     *
     * @var string
     */
    protected $parameters;

    /**
     * getpathFilter
     *
     * Getter for path_filter parameter
     *
     * @return string
     */
    public function getPathFilter()
    {
        return $this->path_filter;
    }

    /**
     * Setter du filtre
     *
     * @param string $path_filter
     */
    public function setPathFilter($path_filter)
    {
        if (empty($path_filter)) {
            $this->clearPathFilter();
        } else {
            $this->path_filter = $path_filter.'/';
        }
    }

    /**
     * addToPathFilter
     *
     * Fonction permettant d'ajouter un path_filter
     *
     * @param string $type
     * @param string $value
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function addToPathFilter($type, $value)
    {
        $this->path_filter .= $type.'/'.$value.'/';
        return $this;
    }

    /**
     * clearPathFilter
     *
     * Fonction permettant de supprimer les filtres
     *
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function clearPathFilter()
    {
        $this->path_filter = null;
        return $this;
    }

    /**
     * getAction
     *
     * Fonction permettant de récupérer l'action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * setAction
     *
     * Setter pour le nom de l'action
     *
     * @param string $action
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function setAction($action)
    {
        if (gettype($action) !== 'string') {
            throw new BadParametersException(
                sprintf(
                    ' The action type ("%s") must be a string',
                    gettype($action)
                )
            );
        }
        $this->action = $action;
        return $this;
    }

    /**
     * Getter des parametres de l'action
     *
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Setter des parametres de l'action
     *
     * @param mixed $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * getRegion
     *
     * Getter du paramètre region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * setRegion
     *
     * Setter du paramètre region
     *
     * @param string $region
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function buildUrl($base)
    {
        $url = $base.$this::getApiName().'/';
        $parameters = http_build_query($this->getParams());
        $region = $this->getRegion();
        if (!is_null($region)) {
            $url .= $region.'/';
            $path_filter = $this->getPathFilter();
            if (!is_null($path_filter)) {
                $url .= $path_filter;
            }
            $action = $this->getAction();
            if (!is_null($action)) {
                $url .= $action;
            }
            if ($parameters !== '') {
                $parameters = preg_replace(
                    '/%5B(?:[0-9]|[1-9][0-9]+)%5D=/',
                    '%5B%5D=',
                    $parameters
                );
                $url .= '?'.$parameters;
            }
        }
        return rtrim($url, '/');
    }

    /**
     * {@inheritDoc}
     */
    protected function buildFactory()
    {
        $factory = new ParametersFactory();
        $factory->setPrefix('coverage');
        $factory->setDefaultClass('CoverageParameters');
        return $factory;
    }

    /**
     * {@inheritDoc}
     */
    protected function buildParametersType()
    {
        $parametersType = Utils::deleteUnderscore($this->getAction());
        return $parametersType;
    }

    /**
     * {@inheritDoc}
     */
    public static function getApiName()
    {
        return 'coverage';
    }
}
