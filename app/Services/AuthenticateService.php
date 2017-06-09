<?php
namespace App\Services;

use Auth;

class AuthenticateService
{
    protected $cache;

    protected $auth;

    public function __construct(CacheService $cacheService,Auth $auth)
    {
        $this->cache = $cacheService;
        $this->auth = $auth::guard('api')->user();
    }

    public function isSuper()
    {
        return $this->auth->is_super();
    }

    public function can($permission)
    {
        return $this->auth->may($permission);
    }

    public function inscode()
    {
        return $this->auth->inscode ?: $this->cache->get('inscode');
    }
}