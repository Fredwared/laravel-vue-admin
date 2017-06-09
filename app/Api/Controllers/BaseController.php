<?php
namespace App\Api\Controllers;

use App\Api\Serializer\CustomSerializer;
use App\Traits\HandleExceptionTrait;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Closure;

class BaseController extends Controller
{
    use Helpers, HandleExceptionTrait;

    protected $service;

    protected function responseJson($data, $message = 'success')
    {
        return response()->json(['status_code' => 200, 'message' => $message, 'data' => $data]);
    }

    protected function item($item, $transformer, Closure $after = null)
    {
        return $this->response->item($item, $transformer, function ($resource, $fractal) {
            $fractal->setSerializer(new CustomSerializer());
        }, $after);
    }
}