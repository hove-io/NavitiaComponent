<?php

namespace Navitia\Component\Tests\Configuration\Processor;

use Navitia\Component\Configuration\Processor\ObjectConfigurationProcessor;
use Navitia\Component\Configuration\NavitiaConfiguration;
use Navitia\Component\Tests\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Description of ObjectConfigurationProcessorTest
 *
 * @author rndiaye
 */
class ObjectConfigurationProcessorTest extends TestCase
{

    private $processor;

    protected function setUp()
    {
        $this->processor = new ObjectConfigurationProcessor();
    }

    /**
     * Test for convertToObjectConfiguration with Exception
     *
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testConvertToObjectConfiguration()
    {
        $service = new NavitiaConfiguration();
        $config = $service->setUrl(Environment::getNavitiaUrl());
        $object = $this->processor->convertToObjectConfiguration($config);
        $this->assertInstanceOf(
            'Navitia\Component\Configuration\NavitiaConfigurationInterface',
            $object
        );
        // Exception with bad config parameters
        $badConfig = 'foo';
        $this->processor->convertToObjectConfiguration($badConfig);
    }

    /**
     * Test for validate with Exception
     *
     * @expectedException Navitia\Component\Exception\BadParametersException
     */
    public function testValidate()
    {
        // Test a required parameter
        $object = new NavitiaConfiguration();
        $this->processor->validate($object);
    }
}
