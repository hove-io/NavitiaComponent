<?php

namespace Navitia\Component\Tests\Cache;

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Psr\Log\LoggerInterface;
use Navitia\Component\Tests\TestCase;

abstract class AbstractCacheTest extends TestCase
{
    protected function mockItemInterface(bool $isHit = true, $getData = null)
    {
        $mock = $this->getMockBuilder(ItemInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['isHit', 'tag', 'set', 'getMetadata', 'getKey', 'get', 'expiresAfter', 'expiresAt'])
            ->getMock();

        $mock
            ->method('isHit')
            ->willReturn($isHit);

        $mock
            ->method('get')
            ->willReturn($getData);

        return $mock;
    }

    protected function mockTagAwareCacheInterface(bool $isHit = true, $getData = null)
    {
        $itemMock = $this->mockItemInterface($isHit, $getData);
        $cacheMock = $this->getMockBuilder(TagAwareCacheInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(['getItem', 'save', 'invalidateTags', 'get', 'delete'])
            ->getMock();

        $cacheMock
            ->method('getItem')
            ->willReturn($itemMock);

        $cacheMock
            ->method('invalidateTags')
            ->willReturn(true);

        $cacheMock
            ->method('save')
            ->willReturn(true);

        return $cacheMock;
    }

    protected function mockLogger()
    {
        return $this->getMockBuilder(LoggerInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->getMock();
    }
}
