<?php
namespace App\Api\Controllers;

use App\Api\Transformers\UserTransformer;
use App\Requests\Auth\LoginRequest;
use App\Services\JWTService;
use Auth;

class LoginController extends BaseController
{
    protected function username()
    {
        return 'username';
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only($this->username(), 'password');

        if ($token = Auth::guard('api')->attempt($credentials)) {
            return $this->sendLoginResponse($token);
        }

        return $this->clientHttpException(411);
    }

    protected function sendLoginResponse($token)
    {
        $user = Auth::guard('api')->user();

        $user->token = $token;

        $user->token_ttl = (new JWTService($token))->getTokenTTL() * 1000; //前端js为毫秒

        return $this->item($user, new UserTransformer());
    }

    public function logout()
    {

        Auth::guard('api')->logout();

        return $this->response->noContent();
    }
}