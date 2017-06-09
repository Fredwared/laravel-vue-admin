<?php
namespace App\Repositories;

use App\User;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    public function paginate(array $columns = ['*'])
    {
        $this->listWith()->orderBy('id', 'desc');

        return parent::paginate($columns);
    }

    public function paginateByInscode($inscode, array $columns = ['*'])
    {
        $this->listWith()->where('inscode', $inscode)->orderBy('id', 'desc');

        return parent::paginate($columns);
    }

    public function listWith()
    {
        $this->model = $this->applyWith([
            'roles' => ['id', 'display_name', 'name'],
            'city' => ['id', 'name']
        ]);
        return $this;
    }

    public function show($id, array $columns = ['*'])
    {
        return $this->with('role')->findOrFail($id, $columns);
    }

    public function showByInscode($inscode, $id, array $columns = ['*'])
    {
        return $this->with('role')->findByGroupOrFail([
            'id' => $id,
            'inscode' => $inscode
        ], $columns);
    }
}