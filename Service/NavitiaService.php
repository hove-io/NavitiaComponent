<?php

/*
 * NavitiaService
 */

namespace Navitia\Component\Service;

use Symfony\Component\Validator\Validation;
use Navitia\Component\Request\NavitiaRequestInterface;
use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Request\Processor\RequestProcessorFactory;
use Navitia\Component\Configuration\Processor\ConfigurationProcessorFactory;
use Navitia\Component\NavitiaExceptionFactory;
use Navitia\Component\Exception\NavitiaNotRespondingException;

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
     * Timeout
     * @var integer
     */
    private $timeout;

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
     * Validation de la requete et appel Navitia si requete valide
     *
     * @param mixed $query
     */
    public function process($query, $format = null, $timeout = 5000, $pagination = true)
    {
        $this->timeout = $timeout;
        $factory = new RequestProcessorFactory();
        $processor = $factory->create(gettype($query));
        $request = $processor->convertToObjectRequest($query);
        $validation = $this->validate($request);
        if ($validation->count() === 0) {
            $result = $this->callApi($request, $format);
            if ($pagination !== false ||
                $result->pagination->total_result <= $result->pagination->items_per_page) {
                return $result;
            } else {
                return $this->deletePagination($request, $format, $result);
            }
        } else {
            return $validation;
        }
    }

    /**
     * Function to delete Navitia pagination
     * Retrieve the result count and call again with count
     * @param NavitiaRequestInterface $request
     * @param string $format
     * @param mixed $result
     * @return mixed
     */
    public function deletePagination($request, $format, $result)
    {
        $parameters = $request->getParameters();
        if (gettype($parameters) === 'string') {
            $parameters .= '&count='.$result->pagination->total_result;
        }
        if (gettype($parameters) === 'array') {
            $parameters['count'] = $result->pagination->total_result;
        }
        $request->setParameters($parameters);
        return $this->callApi($request, $format);
    }
    /**
     * Permet de valider une requete avec les contraintes en annotations
     *
     * @param \Navitia\Component\Request\NavitiaRequestInterface $request
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public function validate(NavitiaRequestInterface $request)
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        $violations = $validator->validate($request->processParameters());
        return $violations;
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
        $token = $this->config->getToken();
        $request_uri = (isset($_SERVER['REQUEST_URI'])) ? basename($_SERVER['REQUEST_URI']) : '';
        if (strpos($request_uri, 'debug=0') === false &&
            (strpos($request_uri, 'debug=1') !== false ||
            strpos($request_uri, 'debug=2') !== false ||
            (isset($_COOKIE['ctp_debug']) && $_COOKIE['ctp_debug'] == '2') ||
            (isset($_COOKIE['ctp_debug']) && $_COOKIE['ctp_debug'] == '1'))) {
            $this->log(
                $url,
                $request->getApiName(),
                array_merge($request->getParams(), array('token'=>$token))
            );
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        if ($token !== null && $token !== '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: '.$token));
        }
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        //Timeout in 5s
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $this->timeout);
        $response = curl_exec($ch);
        $errorMsg = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($response === false) {
            throw new NavitiaNotRespondingException('Navitia not responding: ' . $errorMsg);
        } elseif ($httpCode !== 200) {
            $this->errorProcessor($response, $httpCode);
        }
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
     * Function throwing an exception containing navitia error message and code.
     * if response_error in config is 'exception' Function throwing the exception.
     * else Function return navitia response
     * Default mode is the exception mode
     * @link http://doc.navitia.io/documentation.html#Errors
     *
     * @param string $response
     * @param string $httpCode
     * @return void
     * @throws NavitiaException
     */
    public function errorProcessor($response, $httpCode)
    {
        if ($this->config->getResponseError() === 'exception') {
            $exceptionFactory = new NavitiaExceptionFactory();
            $errorId = null;
            $errorMessage = '';

            $responseObject = json_decode($response);
            if (isset($responseObject->error)) {
                $errorId = $responseObject->error->id;
                $errorMessage = $responseObject->error->message;
            }

            $exception = $exceptionFactory->create($httpCode, $errorId, $errorMessage);

            if (isset($responseObject->exceptions)) {
                $exception->setExceptions($responseObject->exceptions);
            }
            if (isset($responseObject->notes)) {
                $exception->setNotes($responseObject->notes);
            }

            throw $exception;
        }
        return $response;
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
