<?php
namespace App\Traits;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

trait HandleExceptionTrait
{
    protected $statusCodeAndMessage = [
        400 => '令牌无效',
        401 => '令牌过期',
        402 => '缺少令牌',
        404 => '找不到内容',
        411 => '用户名或密码错误',
        412 => '找不到用户',
        503 => '服务器不可用,请稍后再试！'
    ];

    public function failWithNotFound(callable $callable, $statusCode)
    {
        $data = $callable();

        if (!$data) {
            $this->clientHttpException($statusCode);
        }

        return $data;
    }

    public function has($statusCode)
    {
        return array_key_exists($statusCode, $this->statusCodeAndMessage);
    }

    public function serviceHttpException($statusCode = 503)
    {
        throw new ServiceUnavailableHttpException(null, $this->statusCodeAndMessage[$statusCode]);
    }

    public function clientHttpException($statusCode = 404)
    {
        throw new HttpException($statusCode, $this->statusCodeAndMessage[$statusCode]);
    }

}