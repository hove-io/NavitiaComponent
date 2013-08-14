<?php

/**
 * CoverageRequest
 */

namespace Navitia\Component\Request;

use Navitia\Component\Request\Parameters\Processor\CoverageParametersProcessorFactory;

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
     * @var mixed
     */
    protected $action;

    /**
     * Nom de l'action
     *
     * @var string
     */
    protected $actionName;

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
     * Setter du filtre
     *
     * @param string $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter.'/';
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
    public function setAction($action)
    {
        switch (gettype($action)) {
            case 'string':
                $actionArray = explode("?", $action, 2);
                $this->setActionName($actionArray[0]);
                break;
            case 'array':
                $this->setActionName($action['name']);
                break;
            default:

                break;
        }
        $this->action = $action;
        return $this;
    }

    /**
     * Fonction permettant de récupérer le nom de l'action
     *
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * Fonction permettant de setter le nom de l'action
     *
     * @param string $actionName
     * @return \Navitia\Component\Request\CoverageRequest
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
        return $this;
    }

    /**
     * Fonction permettant de faire le process sur les parametres de l'action
     *
     * @return mixed
     */
    public function processParameters()
    {
        $action = $this->getAction();
        $factory = new CoverageParametersProcessorFactory();
        $processor = $factory->create(gettype($action));
        $request = $processor->convertToObjectCoverageParameters($action);
        return $request;
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
        $parameters = http_build_query($this->getParams());
        $region = $this->getRegion();
        if (!is_null($region)) {
            $url .= $region;
            $filter = $this->getFilter();
            if (!is_null($filter)) {
                $url .= $filter;
            }
            $action = $this->getActionName();
            if (!is_null($action)) {
                $url .= $action;
            }
            if (!is_null($parameters)) {
                $url .= '?'.$parameters;
            }
        }
        return rtrim($url, '/');
    }

    /**
     * getParams
     *
     * @return array
     */
    public function getParams()
    {
        $request = $this->processParameters();
        $params = $request->getParams();
        return $params;
    }

    /**
     * {@inheritDoc}
     */
    public static function getApiName()
    {
        return 'coverage';
    }
}
