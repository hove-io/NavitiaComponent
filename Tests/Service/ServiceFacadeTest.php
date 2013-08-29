<?php

namespace Navitia\Component\Tests\Service;

use Navitia\Component\Service\ServiceFacade;
use Navitia\Component\Tests\Logger;

/**
 * Description of ServiceFacadeTest
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ServiceFacadeTest extends \PHPUnit_Framework_TestCase
{
    private $service;
    private $config;
    private $formats;
    private $logger;

    protected function setUp()
    {
        $this->logger = new Logger('test');
        $this->service = ServiceFacade::getInstance($this->logger);
        $this->formats = array('json', 'object', 'xml');
        $this->config = array(
            'url' => 'http://navitia2-ws.ctp.dev.canaltp.fr',
            'version' => 'v1'
        );
    }

    /**
     * Test for getInstance Function
     * The Logger will be a instance of LoggerInterface
     * The Service (ServiceFacade) will be a instance of ServiceFacade
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf(
            'Psr\Log\LoggerInterface',
            $this->logger
        );
        $this->assertInstanceOf(
            'Navitia\Component\Service\ServiceFacade',
            $this->service
        );
    }

    /**
     * Test for setConfiguration function
     *
     * @expectedException Navitia\Component\Exception\NavitiaCreationException
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testSetConfiguration()
    {
        foreach ($this->formats as $format) {
            $this->config['format'] = $format;
            $this->service->setConfiguration($this->config);
            $result = $this->service->getConfiguration();
            $this->assertEquals($this->config, $result);
        }
        // Use a invalid config parameters to have Exception
        $badConfig = array(
            'foo' => 'bar'
        );
        $this->service->setConfiguration($badConfig);
    }

    /**
     * Test for call Function
     *
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testCall()
    {
        $action = 'networks';
        $value = array(
            'api' => 'coverage',
            'parameters' => array(
                'region' => 'PaysDeLaLoire',
                'action' => $action
            )
        );
        // test format
        foreach ($this->formats as $format) {
            $this->config['format'] = $format;
            $this->service->setConfiguration($this->config);
            $result = $this->service->call($value);
            switch ($format) {
                case 'json':
                    $this->assertContains($action, $result);
                    break;
                case 'object':
                    $this->assertObjectHasAttribute($action, $result);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * Test for setLogger function
     */
    public function testSetLogger()
    {
        $this->service->setLogger($this->logger);
        $logger = $this->service->getLogger();
        $this->assertEquals($logger, $this->logger);
    }
}
