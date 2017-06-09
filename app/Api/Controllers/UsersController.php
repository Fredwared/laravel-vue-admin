<?php
namespace App\Api\Controllers;


use App\Services\UserService;
use Dingo\Api\Http\Request;

class UsersController extends BaseController
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->service->index();
    }

    public function search(Request $request)
    {
        $credentials = $request->intersect(['username', 'realname']);


    }
}