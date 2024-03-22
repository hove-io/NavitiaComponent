<?php

namespace Navitia\Component\Cache;

use Navitia\Component\Exception\CacheItemNotFoundException;
use Psr\Log\LoggerInterface;
use Navitia\Component\Service\CurlService;

class Navitia extends Cache
{
    const CACHE_TAG = 'navitia';
    const PUBLICATION_DATE_TTL = 300;
    const PUBLICATION_DATE_API = 'status';
    private string $coverage = '';
    private string $urlApi = '';
    private string $token = '';
    private ?LoggerInterface $logger = null;
    private ?string $cacheTtl = null;

    private function needToCheckPublicationDate(): bool
    {
        $key = self::CACHE_TAG . '.check_' . $this->coverage . '_publication_date';
        $cacheItem = $this->cache->getItem($key);

        if ($cacheItem->isHit()) {
            return false;
        }

        $cacheItem->set(true);
        $cacheItem->expiresAfter(self::PUBLICATION_DATE_TTL);
        $this->cache->save($cacheItem);

        return true;
    }

    public function setCoverage(string $coverage): self
    {
        $this->coverage = $coverage;
        return $this;
    }

    public function setUrlApi(string $urlApi): self
    {
        $this->urlApi = $urlApi;
        return $this;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    public function setCacheTtl(?string $cacheTtl = null): self
    {
        $this->cacheTtl = $cacheTtl;
        return $this;
    }

    public function generateCacheKey(?array $specificArgs): string
    {
        $backtrace = debug_backtrace()[1];
        $args['class'] = $backtrace['class'];
        $args['method'] = $backtrace['function'];
        $cacheArgs = array_merge($args, $specificArgs ?? $backtrace['args']);
        $key = md5(http_build_query($cacheArgs));
        $cacheKey = sprintf('%s.%s.%s', self::CACHE_TAG, $this->coverage, $key);

        return $this->adaptKey($cacheKey);
    }

    private function getCacheTag(): string
    {
        return self::CACHE_TAG . '_' .$this->coverage;
    }

    private function checkPublicationDate(): void
    {
        $key = self::CACHE_TAG . '.' . $this->coverage . '_publication_date';
        $cacheItem = $this->cache->getItem($key);
        $publicationDateInCache = null;

        if ($cacheItem->isHit()) {
            $publicationDateInCache = $cacheItem->get();
        }
        $currentPublicationDate = $this->getPublicationDate();

        if ($currentPublicationDate !== null && $currentPublicationDate !== $publicationDateInCache) {
            $cacheItem->set($currentPublicationDate);
            $this->cache->save($cacheItem);
            $this->cache->invalidateTags([$this->getCacheTag()]);
        }
    }

    /**
     * return mixed
     */
    public function getCachedItem(string $cacheKey)
    {
        if ($this->needToCheckPublicationDate()) {
            $this->checkPublicationDate();
        }
        $cacheItem = $this->cache->getItem($cacheKey);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        throw new CacheItemNotFoundException('No item found in cache with key ' . $cacheKey);
    }

    public function setCacheItem(string $cacheKey, $data): void
    {
        $cacheItem = $this->cache->getItem($cacheKey);

        $cacheItem->tag([$this->getCacheTag()]);
        $cacheItem->set($data);
        if ($this->cacheTtl) {
            $cacheItem->expiresAfter(intval($this->cacheTtl, 10));
        }
        $this->cache->save($cacheItem);
    }

    private function getPublicationDate(): string
    {
        try {
            $url = $this->urlApi.'coverage/'.$this->coverage.'/'.self::PUBLICATION_DATE_API;
            $ch = new CurlService($url, 6000, $this->token, $this->logger);
            $curlResponse = $ch->process();
            $response = json_decode($curlResponse['response']);

            return $response->status->publication_date;
        } catch (\Exception $e) {
            $this->logger->warning(
                'Error while getting publication date',
                [
                    'api' => $url,
                    'error' => $e->getMessage()
                ]
            );

            return null;
        }
    }
}
