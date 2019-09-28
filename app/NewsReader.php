<?php

namespace App;

use App\Exceptions\NewsException;
use Illuminate\Support\Facades\App;
use Psr\SimpleCache\CacheInterface;

class NewsReader implements NewsReaderInterface
{
    protected $url = 'https://www.tvnet.lv/rss';
    protected $cacheTimeoutSec = 600;
    protected $cache;
    
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }
    
    protected function getCacheKey(): string
    {
        return 'App\NewsReader#news#' . App::environment();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getNews(): string
    {
        $rss = $this->cache->get($this->getCacheKey());
        
        if ($rss !== null) {
            assert(is_string($rss), '$rss (from cache) must be string, but is: ' . var_export($rss, true));
            return $rss;
        }
        
        $rss = @file_get_contents($this->url);

        if ($rss === false) {
            throw new NewsException('Cannot fetch RSS feed from server.');
        }
        
        $this->cache->set($this->getCacheKey(), $rss, $this->cacheTimeoutSec);
        
        return $rss;
    }
}
