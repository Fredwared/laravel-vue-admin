<?php
namespace App\Http\Middleware;

use App\Services\JWTService;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class GetUserFromToken extends BaseMiddleware
{
    public function handle($request, \Closure $next)
    {
        $user = app(JWTService::class)->getAuthenticateUser();

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}