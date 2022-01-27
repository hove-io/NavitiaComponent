<?php

namespace Navitia\Component\Tests\Configuration\Processor;

use Navitia\Component\Configuration\NavitiaConfigurationInterface;
use Navitia\Component\Exception\BadParametersException;
use Navitia\Component\Configuration\Processor\ObjectConfigurationProcessor;
use Navitia\Component\Configuration\NavitiaConfiguration;
use Navitia\Component\Tests\Environment;
use Navitia\Component\Tests\TestCase;

/**
 * Description of ObjectConfigurationProcessorTest
 *
 * @author rndiaye
 */
class ObjectConfigurationProcessorTest extends TestCase
{
    private ObjectConfigurationProcessor $processor;

    protected function setUp(): void
    {
        $this->processor = new ObjectConfigurationProcessor();
    }

    public function testConvertToObjectConfiguration()
    {
        $this->expectException(BadParametersException::class);
        $service = new NavitiaConfiguration();
        $config = $service->setUrl(Environment::getNavitiaUrl());
        $object = $this->processor->convertToObjectConfiguration($config);
        $this->assertInstanceOf(NavitiaConfigurationInterface::class, $object);
        // Exception with bad config parameters
        $badConfig = 'foo';
        $this->processor->convertToObjectConfiguration($badConfig);
    }

    public function testValidate()
    {
        $this->expectException(BadParametersException::class);

        // Test a required parameter
        $object = new NavitiaConfiguration();
        $this->processor->validate($object);
    }
}
