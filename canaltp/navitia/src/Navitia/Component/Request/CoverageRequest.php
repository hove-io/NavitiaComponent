<?php

/**
 * CoverageRequest
 */

namespace Navitia\Component\Request;

use Navitia\Component\Exception\BadParametersException;

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
     * filter
     *
     * @var string
     */
    protected $filter;

    /**
     * action
     *
     * @var string
     */
    protected $action;

    /**
     * getFilter
     *
     * Getter for filter parameter
     *
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * addToFilter
     *
     * Fonction permettant d'ajouter un filter
     *
     * @param string $type
     * @param string $value
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function addToFilter($type, $value)
    {
        $this->filter .= $type.'/'.$value.'/';
        return $this;
    }

    /**
     * clearFilter
     *
     * Fonction permettant de supprimer les filtres
     *
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function clearFilter()
    {
        $this->filter = null;
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
     * Setter pour le parametre action
     *
     * @param string $action
     * @param string $params
     * @return \Navitia\Component\Request\CoverageRequest
     * @throws Exception
     */
    public function setAction($action, $params = null)
    {
        $this->action = $action;
        if (!is_null($params)) {
            if (!is_string($params)) {
                throw new BadParametersException(
                    sprintf('The parameter for "%s" action will be a string', $action)
                );
            }
            $this->action .= '?'.$params;
        }
        return $this;
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
        $this->region = $region.'/';
        return $this;
    }

    /**
     * buildUrl
     *
     * Contructeur de l'url
     *
     * @param string $base
     * @return string
     */
    public function buildUrl($base)
    {
        $url = $base.$this::getApiName().'/';
        $region = $this->getRegion();
        if (!is_null($region)) {
            $url .= $region;
            $filter = $this->getFilter();
            if (!is_null($filter)) {
                $url .= $filter;
            }
            $action = $this->getAction();
            if (!is_null($action)) {
                $url .= $action;
            }
        }
        return rtrim($url, '/');
    }

    /**
     * {@inheritDoc}
     */
    public static function getApiName()
    {
        return 'coverage';
    }
}
