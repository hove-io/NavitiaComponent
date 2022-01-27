<?php

namespace Navitia\Component\Tests\Cache;

use Navitia\Component\Cache\Navitia as NavitiaCache;
use Navitia\Component\Tests\Environment;

class NavitiaTest extends AbstractCacheTest
{
    private NavitiaCache $navitiaCache;

    /**
     * @dataProvider generateCacheKeyDataProvider
     */
    public function testGenerateCacheKey(array $params, string $keyExpected): void
    {
        $this->initNavitiaCache(true, $params);
        $result = $this->navitiaCache->generateCacheKey($params);

        $this->assertSame($keyExpected, $result);
    }

    public function generateCacheKeyDataProvider(): array
    {
        return [
            [[], 'navitia.jdr.5135642ea97189da85022726453fe791'],
            [['one'], 'navitia.jdr.14618128672b19319e1bfde47320ff9b'],
            [['one', 'two'], 'navitia.jdr.8800e59d6a7454b7c454e8087377046f']
        ];
    }

    /**
     * @dataProvider getCachedItemDataProvider
     */
    public function testGetCachedItem(mixed $storedData): void
    {
        $this->initNavitiaCache(true, $storedData);
        $dataFromCache = $this->navitiaCache->getCachedItem('test');

        $this->assertSame($storedData, $dataFromCache);
    }

    public function getCachedItemDataProvider(): array
    {
        return [
            ['test'],
            [rand(1, 10)],
            [['a', 'b']],
            [false],
        ];
    }

    private function initNavitiaCache(bool $isHit, mixed $getData)
    {
        $this->navitiaCache = new NavitiaCache($this->mockTagAwareCacheInterface($isHit, $getData));
        $this->navitiaCache->setCoverage(Environment::getNavitiaCoverage());
        $this->navitiaCache->setUrlApi(Environment::getNavitiaUrl().'/v1/');
        $this->navitiaCache->setToken(Environment::getNavitiaToken());
        $this->navitiaCache->setLogger($this->mockLogger());
    }
}
