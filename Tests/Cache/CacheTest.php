<?php

namespace Navitia\Component\Tests\Cache;

use Navitia\Component\Cache\Cache;
use Symfony\Contracts\Cache\ItemInterface;

class CacheTest extends AbstractCacheTest
{
    private Cache $cache;

    protected function setUp()
    {
        $this->cache = new Cache($this->mockTagAwareCacheInterface());
    }

    /**
     * @dataProvider getAdaptKeyDataProvider
     */
    public function testAdaptKey(string $key, string $expected): void
    {
        $result = $this->cache->adaptKey($key);

        $this->assertSame($result, $expected);
    }

    public function getAdaptKeyDataProvider(): array
    {
        return [
            [
                '{}()/\@:',
                '________'
            ],
            [
                '{}(abc)/\@:',
                '___abc_____'
            ],
            [
                'navitia.jdr_publication_date',
                'navitia.jdr_publication_date'
            ],
            [
                'navitia.getPtObject_abc',
                'navitia.getPtObject_abc'
            ]
        ];
    }

    public function testGetItem(): void
    {
        $result = $this->cache->getItem('key');

        $this->assertInstanceOf(ItemInterface::class, $result);
    }

    public function testSave(): void
    {
        $result = $this->cache->save($this->mockItemInterface());

        $this->assertTrue($result);
    }

    public function testInvalidateTags(): void
    {
        $result = $this->cache->invalidateTags(['tag1', 'tag2']);

        $this->assertTrue($result);
    }
}
