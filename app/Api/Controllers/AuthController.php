<?php
namespace App\Api\Controllers;

use App\Services\JWTService;
use Auth;

class AuthController extends BaseController
{
    public function refreshToken()
    {
        $token = Auth::guard('api')->refresh();

        $ttl = (new JWTService($token))->getTokenTTL() * 1000; //前端js为毫秒

        return $this->responseJson(compact('token', 'ttl'));
    }
}