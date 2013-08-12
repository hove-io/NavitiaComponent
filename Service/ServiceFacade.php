<?php

/*
 * ServiceFacade
 */

namespace Navitia\Component\Service;

use Navitia\Component\Service\NavitiaService;
use Navitia\Component\Service\NavitiaServiceInterface;

/**
 * Description of ServiceFacade
 *
 * @author rndiaye
 */
class ServiceFacade
{
    private static $instance = null;
    private $service;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            $instance = new ServiceFacade();
            $instance->setService(new NavitiaService());
            self::$instance = $instance;
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
        return $service->process($call, $format);
    }

    /**
     * Facade de setter de la configuration
     * @param mixed $config
     * @return type
     */
    public function setConfiguration($config)
    {
        $service = $this->getService();
        return $service->processConfiguration($config);
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
}
