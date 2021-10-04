<?php

/*
 * ServiceFacade
 */

namespace Navitia\Component\Service;

use Navitia\Component\Service\NavitiaService;
use Navitia\Component\Service\NavitiaServiceInterface;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Psr\Log\LoggerInterface;

/**
 * Description of ServiceFacade
 *
 * @author rndiaye
 */
class ServiceFacade
{
    private static $instance = null;
    private NavitiaServiceInterface $service;
    private ?LoggerInterface $logger = null;
    private $config;
    private ?TagAwareAdapter $cache = null;

    public static function getInstance(?LoggerInterface $logger = null)
    {
        if (is_null(self::$instance)) {
            $instance = new ServiceFacade();
            $instance->setService(new NavitiaService());
            self::$instance = $instance;
        }
        if (!is_null($logger)) {
            self::$instance->setLogger($logger);
        }
        return self::$instance;
    }

    /**
     * Call navitia
     */
    public function call(
        $call,
        ?string $format = null,
        ?int $timeout = null,
        bool $pagination = true,
        bool $enableCache = true
    ) {
        $service = $this->getService();
        $service->setLogger($this->getLogger());
        return $service->process($call, $format, $timeout, $pagination, $enableCache);
    }

    /**
     * Setter configuration
     * @param mixed $config
     */
    public function setConfiguration($config): self
    {
        $this->config = $config;
        $service = $this->getService();
        $service->processConfiguration($this->config);
        return $this;
    }

    public function setCache(TagAwareAdapter $cache): self
    {
        $this->cache = $cache;
        $service = $this->getService();
        $service->processCache($this->cache);
        return $this;
    }

    /**
     * Getter configuration
     *
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->config;
    }

    public function getService(): NavitiaServiceInterface
    {
        return $this->service;
    }

    public function setService(NavitiaServiceInterface $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }
}
