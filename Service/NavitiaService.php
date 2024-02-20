<?php

namespace Navitia\Component\Service;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Navitia\Component\Exception\CacheItemNotFoundException;
use Navitia\Component\Request\NavitiaRequestInterface;
use Navitia\Component\Request\RequestFactory;
use Navitia\Component\Request\Processor\RequestProcessorFactory;
use Navitia\Component\Configuration\Processor\ConfigurationProcessorFactory;
use Navitia\Component\NavitiaExceptionFactory;
use Navitia\Component\Exception\BadParametersException;
use Navitia\Component\Service\CurlService;
use Navitia\Component\Cache\Navitia as NavitiaCache;

/**
 * Description of NavitiaService
 *
 * @author rndiaye
 */
class NavitiaService implements NavitiaServiceInterface, LoggerAwareInterface
{
    private $config;
    private LoggerInterface $logger;
    private int $timeout;
    private ?NavitiaCache $cache = null;

    /**
     * processConfiguration
     * Conversion de la configuration en object NavitiaConfiguration
     * Validation de la configuration
     */
    public function processConfiguration($config): void
    {
        $factory = new ConfigurationProcessorFactory();
        $processor = $factory->create(gettype($config));
        $config = $processor->convertToObjectConfiguration($config);
        $processor->validate($config);
        $this->config = $config;
    }

    public function processCache(?TagAwareAdapter $cache): void
    {
        if (!is_null($cache)) {
            $this->cache = new NavitiaCache($cache);
        }
    }

    private function hasCache(): bool
    {
        return !is_null($this->cache);
    }

    /**
     * Conversion de query en object NavitiaRequest
     * Validation de la requete et appel Navitia si requete valide
     */
    public function process(
        $query,
        ?string $format = null,
        ?int $timeout = null,
        bool $pagination = true,
        bool $enableCache = true
    ) {
        $this->timeout = $timeout ?? $this->config->getTimeout();
        $factory = new RequestProcessorFactory();
        $processor = $factory->create(gettype($query));
        $request = $processor->convertToObjectRequest($query);
        $validation = $this->validate($request);
        if ($validation->count() !== 0) {
            return $validation;
        }
        $result = $this->callApi($request, $format, $enableCache);
        $pagination_total_result_le_pagination_item_per_page = false;
        if (isset($result->pagination)) {
            if ($result->pagination->total_result <= $result->pagination->items_per_page) {
                $pagination_total_result_le_pagination_item_per_page = true;
            }
        }
        if ($pagination !== false ||
            $pagination_total_result_le_pagination_item_per_page) {
            return $result;
        } else {
            return $this->deletePagination($request, $format, $result);
        }
    }

    /**
     * Function to delete Navitia pagination
     * Retrieve the result count and call again with count
     */
    public function deletePagination(
        NavitiaRequestInterface $request,
        ?string $format,
        $result
    ) {
        $parameters = $request->getParameters();
        $result_pagination_total_result = 0;
        if (isset($result->pagination)) {
            $result_pagination_total_result = $result->pagination->total_result;
        }

        if (gettype($parameters) === 'string') {
            $parameters .= '&count='.$result_pagination_total_result;
        }
        if (gettype($parameters) === 'array') {
            $parameters['count'] = $result_pagination_total_result;
        }
        $request->setParameters($parameters);
        return $this->callApi($request, $format);
    }
    /**
     * Permet de valider une requete avec les contraintes en annotations
     */
    public function validate(NavitiaRequestInterface $request): ConstraintViolationListInterface
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
    public function generateRequest($api): NavitiaRequestInterface
    {
        $factory = new RequestFactory();
        return $factory->create($api);
    }

    private function setCacheProperties(
        string $coverage,
        string $urlApi,
        string $token
    ): void {
        if ($this->hasCache()) {
            $this->cache->setCoverage($coverage);
            $this->cache->setUrlApi($urlApi);
            $this->cache->setToken($token);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function callApi(
        NavitiaRequestInterface $request,
        ?string $format,
        bool $enableCache = true
    ) {
        $baseUrl = $this->config->getUrl().'/'.$this->config->getVersion().'/';
        $url = $request->buildUrl($baseUrl);
        $token = $this->config->getToken();
        $this->log(
            $url,
            $request->getApiName(),
            array_merge($request->getParams(), array('token' => $token))
        );
        $this->setCacheProperties($request->getRegion(), $baseUrl, $token);
        $curlResponse = $this->getApiResponse($url, $token, $enableCache);

        $response = $curlResponse['response'];
        $curlError = $curlResponse['curlError'];
        $httpCode = $curlResponse['httpCode'];

        if ($httpCode !== 200) {
            $this->errorProcessor($response, $httpCode);
        }
        return $this->responseProcessor($response, $format, $curlError);

    }

    private function getApiResponse(
        string $url,
        string $token,
        bool $enableCache = true
    ): array {
        if ($this->hasCache() && $enableCache) {
            $cacheKey = $this->cache->generateCacheKey([$url, $token]);
            try {
                return $this->cache->getCachedItem($cacheKey);
            } catch (CacheItemNotFoundException $e) {

                $ch = new CurlService($url, $this->timeout, $token, $this->logger);
                $result = $ch->process();
                if ($result['httpCode'] === 200) {
                    $this->cache->setCacheItem($cacheKey, $result);
                }
            }
        } else {
            $ch = new CurlService($url, $this->timeout, $token, $this->logger);
            $result = $ch->process();
        }

        return $result;
    }

    /**
     * Fonction permettant de fournir la sortie en fonction du format donné
     * @throws BadParametersException
     */
    public function responseProcessor(string $response, ?string $format, array $curlError)
    {
        $format = (is_null($format)) ? $this->config->getFormat() : $format;
        switch ($format) {
            case 'json':
                return $response;
            case 'object':
                if ('NO_CURL_ERROR' == current($curlError)) {
                    return json_decode($response);
                } else {
                    $responseError = new \stdClass();
                    $responseError->error = $curlError;
                    return $responseError;
                }
                break;
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
     * @throws NavitiaException
     */
    public function errorProcessor(string $response, string $httpCode)
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
     */
    protected function log(string $url, string $api, array $parameters): void
    {

        if ($this->logger !== null) {
            $this->logger->debug(
                $url,
                array(
                    'api' => $api,
                    'parameters' => $parameters
                )
            );
        }
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        if ($this->hasCache()) {
            $this->cache->setLogger($this->logger);
        }
        return $this;
    }
}
