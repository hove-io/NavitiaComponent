<?php

namespace Navitia\Component\Tests\Service;

use \TypeError;
use Psr\Log\LoggerInterface;
use Navitia\Component\Service\ServiceFacade;
use Navitia\Component\Tests\Logger;
use Navitia\Component\Tests\Environment;
use Navitia\Component\Tests\TestCase;
use Navitia\Component\Exception\NavitiaCreationException;

/**
 * Description of ServiceFacadeTest
 *
 * @copyright (c) 2013, CANALTP
 * @author rndiaye
 */
class ServiceFacadeTest extends TestCase
{
    private ServiceFacade $service;
    private array $config;
    private array $formats;
    private Logger $logger;

    protected function setUp(): void
    {
        $this->logger = new Logger('test');
        $this->service = ServiceFacade::getInstance($this->logger);
        $this->formats = ['json', 'object', 'xml'];
        $this->config = [
            'url' => Environment::getNavitiaUrl(),
            'version' => 'v1',
            'token' => Environment::getNavitiaToken(),
        ];
    }

    /**
     * Test for getInstance Function
     * The Logger will be a instance of LoggerInterface
     * The Service (ServiceFacade) will be a instance of ServiceFacade
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf(LoggerInterface::class, $this->logger);
        $this->assertInstanceOf(ServiceFacade::class, $this->service);
    }

    public function testSetConfiguration()
    {
        $this->expectException(NavitiaCreationException::class);

        foreach ($this->formats as $format) {
            $this->config['format'] = $format;
            $this->service->setConfiguration($this->config);
            $result = $this->service->getConfiguration();
            $this->assertEquals($this->config, $result);
        }
        // Use a invalid config parameters to have Exception
        $badConfig = ['foo' => 'bar',];
        $this->service->setConfiguration($badConfig);
    }

    public function testCall()
    {
        $this->expectException(TypeError::class);

        $action = 'networks';
        $value = [
            'api' => 'coverage',
            'parameters' => [
                'region' => 'jdr',
                'action' => $action,
            ],
        ];
        // test format
        foreach ($this->formats as $format) {
            $this->config['format'] = $format;
            $this->service->setConfiguration($this->config);
            $result = $this->service->call($value);
            $this->assertNotSame(false, $result);
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
