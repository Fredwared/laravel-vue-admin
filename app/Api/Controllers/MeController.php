<?php
namespace App\Api\Controllers;

use App\Api\Transformers\UserTransformer;
use Auth;

class MeController extends BaseController
{
    public function me()
    {
        $user = Auth::guard('api')->user();

        return $this->item($user, new UserTransformer);
    }
}