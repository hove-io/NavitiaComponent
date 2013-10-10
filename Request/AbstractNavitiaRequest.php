<?php

/*
 * AbstractNavitiaRequest
 */

namespace Navitia\Component\Request;

use Navitia\Component\Request\Parameters\Processor\ParametersProcessorFactory;
use Navitia\Component\Request\Parameters\ParametersFactory;
use Navitia\Component\Utils;

/**
 * Description of AbstractNavitiaRequest
 *
 * @author rndiaye
 */
abstract class AbstractNavitiaRequest implements NavitiaRequestInterface
{
    /**
     * BuildUrl
     *
     * @param string $base
     * @return string
     */
    public function buildUrl($base)
    {
        $url = $base.$this::getApiName();
        $parameters = http_build_query($this->getParams());
        if (!empty($parameters)) {
            $parameters = preg_replace(
                '/%5B(?:[0-9]|[1-9][0-9]+)%5D=/',
                '%5B%5D=',
                $parameters
            );
            $url .= '?'.$parameters;
        }
        return $url;
    }

    /**
     * Fonction de process pour les parametres
     *
     * @return mixed
     */
    public function processParameters()
    {
        $parameters = $this->getParameters();
        $factory = $this->buildFactory();
        $parametersType = $this->buildParametersType();
        $request = $factory->create($parametersType);
        if (!is_null($parameters)) {
            $processorFactory = new ParametersProcessorFactory();
            $processor = $processorFactory->create(gettype($parameters));
            $request = $processor->convertToObjectParameters(
                $request,
                $parameters
            );
        }
        return $request;
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
     * Fonction permettant de créer le factory de coverage
     *
     * @return \Navitia\Component\Request\Parameters\ParametersFactory
     */
    protected function buildFactory()
    {
        $factory = new ParametersFactory();
        return $factory;
    }

    /**
     * Fonction permettant d'avoir la classe à créer pour les parameters
     *
     * @return string
     */
    protected function buildParametersType()
    {
        $parametersType = Utils::deleteUnderscore($this->getApiName());
        return $parametersType;
    }
}
