<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Dingo\Api\Http\Request;

class UserService extends ModelService
{
    public function __construct(UserRepository $repository, AuthenticateService $authenticateService)
    {
        $this->repository = $repository;
        $this->auth = $authenticateService;
    }

    public function index()
    {
        if ($this->canAll()) {
            return $this->repository->paginate($this->listColumns());
        }

        return $this->repository->paginateByInscode($this->auth->inscode(), $this->listColumns());
    }

    protected function canAll()
    {
        return $this->auth->isSuper() || $this->auth->can('user.all');
    }

    public function show($id)
    {
        if ($this->canAll()) {
            return $this->repository->show($id, $this->itemColumns());
        }

        return $this->repository->showByInscode($this->auth->inscode(), $this->itemColumns());
    }

    public function listColumns()
    {
        return [
            'id', 'username', 'email', 'realname', 'mobile', 'is_super', 'city_id', 'inscode'
        ];
    }

    public function itemColumns()
    {
        return [
            'id', 'username', 'email', 'realname', 'mobile', 'is_super', 'city_id'
        ];
    }
}