<?php
namespace App\Services;

use Illuminate\Cache\Repository;
use Auth;

class CacheService
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function tags()
    {
        return $this->cache->tags('admin:user:' . Auth::guard('api')->user()->id);
    }

    public function get($key)
    {
        return $this->tags()->get($key);
    }

    public function has($key)
    {
        return $this->tags()->has($key);
    }

    public function put($key, $value, $minutes = 10)
    {
         $this->tags()->put($key, $value, $minutes);
    }

    public function forever($key, $value)
    {
         $this->tags()->forever($key, $value);
    }

    public function flush()
    {
         $this->tags()->flush();
    }
}