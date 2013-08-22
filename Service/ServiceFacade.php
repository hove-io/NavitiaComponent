<?php

/*
 * ServiceFacade
 */

namespace Navitia\Component\Service;

use Navitia\Component\Service\NavitiaService;
use Navitia\Component\Service\NavitiaServiceInterface;
use Psr\Log\LoggerInterface;

/**
 * Description of ServiceFacade
 *
 * @author rndiaye
 */
class ServiceFacade
{
    private static $instance = null;
    private $service;
    private $logger = null;
    private $config;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(LoggerInterface $logger = null)
    {
        if (is_null(self::$instance)) {
            $instance = new ServiceFacade();
            $instance->setService(new NavitiaService());
            self::$instance = $instance;
        }
        if ($logger) {
            $instance->setLogger($logger);
        }
        return self::$instance;
    }

    /**
     * Facade d'appel Navitia
     * @param mixed $call
     * @return type
     */
    public function call($call, $format = null)
    {
        $service = $this->getService();
        $service->setLogger($this->getLogger());
        return $service->process($call, $format);
    }

    /**
     * Facade de setter de la configuration
     * @param mixed $config
     * @return NavitiaService
     */
    public function setConfiguration($config)
    {
        $this->config = $config;
        $service = $this->getService();
        return $service->processConfiguration($this->config);
    }

    /**
     * Getter de la configuration
     *
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->config;
    }
    /**
     *
     * @return NavitiaServiceInterface
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     *
     * @param NavitiaServiceInterface $service
     * @return \Navitia\Component\Service\ServiceFacade
     */
    public function setService(NavitiaServiceInterface $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Getter du logger
     *
     * @return \Psr\Log\LoggerInterface $logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Setter du logger
     *
     * @param \Psr\Log\LoggerInterface $logger
     * @return \Navitia\Component\Service\ServiceFacade
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }
}
