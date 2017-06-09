<?php
namespace App\Services;

use App\Traits\HandleExceptionTrait;

class ModelService
{
    use HandleExceptionTrait;

    protected $repository;

    protected $auth;
}