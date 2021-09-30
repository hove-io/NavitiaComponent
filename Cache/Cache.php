<?php

namespace Navitia\Component\Cache;

use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class Cache
{
    const INVALID_REDIS_SEARCH = ['{', '}', '(', ')', '/', "\\", '@', ':'];
    const INVALID_REDIS_REPLACE = '_';

    protected TagAwareCacheInterface $cache;

    // using autowiring to inject the cache pool
    public function __construct(TagAwareCacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function adaptKey(string $key): string
    {
        return str_replace(self::INVALID_REDIS_SEARCH, self::INVALID_REDIS_REPLACE, $key);
    }

    public function getItem(string $key): ItemInterface
    {
        return $this->cache->getItem($key);
    }

    public function save(ItemInterface $item): bool
    {
        return $this->cache->save($item);
    }

    public function invalidateTags(array $tags): bool
    {
        return $this->cache->invalidateTags($tags);
    }
}
