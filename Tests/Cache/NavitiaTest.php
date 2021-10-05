<?php

namespace Navitia\Component\Tests\Cache;

use Navitia\Component\Cache\Navitia as NavitiaCache;
use Navitia\Component\Exception\CacheItemNotFoundException;
use Navitia\Component\Tests\Environment;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class NavitiaTest extends AbstractCacheTest
{
    private NavitiaCache $navitiaCache;

    protected function setUp()
    {
        $this->navitiaCache = new NavitiaCache($this->mockTagAwareCacheInterface());
        $this->setSetter($this->navitiaCache);
    }

    protected function setSetter(NavitiaCache $navitiaCache): void
    {
        $navitiaCache->setCoverage(Environment::getNavitiaCoverage());
        $navitiaCache->setUrlApi(Environment::getNavitiaUrl().'/v1/');
        $navitiaCache->setToken(Environment::getNavitiaToken());
        $navitiaCache->setLogger($this->mockLogger());
    }

    /**
     * @dataProvider generateCacheKeyDataProvider
     */
    public function testGenerateCacheKey(array $params, string $keyExpected): void
    {
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
    public function testGetCachedItem(bool $isHit = true, $getData = null, bool $exceptedException = false): void
    {
        if ($exceptedException) {
            $this->expectException(CacheItemNotFoundException::class);
        }
        $navitiaCache = new NavitiaCache($this->mockTagAwareCacheInterface($isHit, $getData));
        $this->setSetter($navitiaCache);
        $result = $navitiaCache->getCachedItem('test');
        if (!$exceptedException) {
            $this->assertSame($getData, $result);
        }
    }

    public function getCachedItemDataProvider(): array
    {
        return [
            [true, 'test', false],
            [false, null, true]
        ];
    }
}
