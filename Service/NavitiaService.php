<?php

/*
 * NavitiaService
 */

namespace Navitia\Component\Service;

use Navitia\Component\Request\NavitiaRequestInterface;
use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Request\Processor\RequestProcessorFactory;
use Navitia\Component\Configuration\Processor\ConfigurationProcessorFactory;
use Navitia\Component\Exception\BadParametersException;

/**
 * Description of NavitiaService
 *
 * @author rndiaye
 */
class NavitiaService implements NavitiaServiceInterface
{
    /**
     * Configuration
     *
     * @var mixed
     */
    private $config;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * processConfiguration
     * Conversion de la configuration en object NavitiaConfiguration
     * Validation de la configuration
     *
     * @param mixed $config
     */
    public function processConfiguration($config)
    {
        $factory = new ConfigurationProcessorFactory();
        $processor = $factory->create(gettype($config));
        $config = $processor->convertToObjectConfiguration($config);
        $processor->validate($config);
        $this->config = $config;
    }

    /**
     * Conversion de query en object NavitiaRequest
     * Appel Navitia
     *
     * @param mixed $query
     */
    public function process($query, $format = null)
    {
        $factory = new RequestProcessorFactory();
        $processor = $factory->create(gettype($query));
        $request = $processor->convertToObjectRequest($query);
        return $this->callApi($request, $format);
    }

    /**
     * {@inheritDoc}
     */
    public function generateRequest($api)
    {
        $factory = new RequestFactory();
        return $factory->create($api);
    }

    /**
     * {@inheritDoc}
     */
    public function callApi(NavitiaRequestInterface $request, $format)
    {
        $baseUrl = $this->config->getUrl().'/'.$this->config->getVersion().'/';
        $url = $request->buildUrl($baseUrl);
        $this->log($url, $request->getApiName(), $request->getParams());
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $this->responseProcessor($response, $format);
    }

    /**
     * Fonction permettant de fournir la sortie en fonction du format donné
     *
     * @param string $response
     * @param mixed $format
     * @return mixed
     * @throws BadParametersException
     */
    public function responseProcessor($response, $format)
    {
        $format = (is_null($format)) ? $this->config->getFormat() : $format;
        switch ($format) {
            case 'json':
                return $response;
            case 'object':
                return json_decode($response);
            default:
                throw new BadParametersException(
                    sprintf('the "%s" format is not supported.', $format)
                );
        }
    }

    /**
     * Appel à la fonction debug du logger LoggerInterface
     *
     * @param string $url
     * @param string $api
     * @param array $parameters
     */
    protected function log($url, $api, $parameters)
    {
        $logger = $this->getLogger();
        if ($logger !== null) {
            $logger->debug(
                $url,
                array(
                    'api' => $api,
                    'parameters' => $parameters
                )
            );
        }
    }

    /**
     * Getter du logger
     *
     * @return type
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Setter du logger
     *
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
