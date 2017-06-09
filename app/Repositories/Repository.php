<?php
namespace App\Repositories;

use App\Traits\HandleExceptionTrait;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    use HandleExceptionTrait;

    protected $model;
    protected $app;
    protected $pageNum = 15;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    public function where($columns, $operator = null, $value = null, $boolean = 'and')
    {
        $this->model = $this->model->where($columns, $operator, $value, $boolean);
        return $this;
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findOrFail($id, array $columns = ['*'])
    {
        return $this->failWithNotFound(function () use ($id, $columns) {
            return $this->find($id, $columns);
        });
    }

    public function findBy($field, $value, array $columns = ['*'])
    {
        return $this->where($field, $value)->first($columns);
    }

    public function findByOrFail($field, $value, array $columns = ['*'])
    {
        return $this->failWithNotFound(function () use ($field, $value, $columns) {
            return $this->findBy($field, $value, $columns);
        });
    }

    public function findByGroup(array $fields, array $columns= ['*'])
    {
        return $this->applyWhere($fields)->first($columns);
    }

    public function findByGroupOrFail(array $fields, array $columns= ['*'])
    {
        return $this->failWithNotFound(function () use ($fields, $columns) {
            return $this->applyWhere($fields)->first($columns);
        });
    }

    public function refresh()
    {
        $this->makeModel();

        return $this;
    }

    public function applyWhere(array $query)
    {
        return $this->where(function($model) use ($query)  {
            foreach ($query as $key => $value) {
                if ($value === '') {
                    continue;
                } elseif ($value === 'notNull') {
                    $model->whereNotNull($key);
                } elseif ($value === '0' || $value === 0) {
                    $model->where($key, $value);
                } elseif ($value === null) {
                    $model->whereNull($key);
                } elseif (is_array($value) && !empty($value)) {
                    list($k, $v) = $value;
                    switch ($k) {
                        case 'like' :
                            $model->where($key, 'like', '%'.$v.'%');
                            break;
                        case 'or' :
                            $model->orWhere($key, $v);
                            break;
                        default :
                            $model->whereIn($key, $value);
                    }
                }
            }
        });
    }

    public function orderBy($filed, $sort = 'asc')
    {
        $this->model = $this->model->orderBy($filed, $sort);
        return $this;
    }

    public function first(array $columns = ['*'])
    {
        return $this->model->first($columns);
    }

    public function get(array $columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function paginate(array $columns = ['*'])
    {
        return $this->model->paginate($this->pageNum, $columns);
    }

    public function search($condition, array $columns = ['*'])
    {
        return $this->applyWhere($condition)->paginate($columns);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function limit($num)
    {
        $this->model = $this->model->limit($num);

        return $this;
    }

    public function applyWith(array $query)
    {
        foreach ($query as $key => $value) {
            if  (!is_array($value)) {
                throw new \InvalidArgumentException('column must be array!');
            }

            $this->model = $this->model->withCertain($key, $value);
        }

        return $this;
    }

    public function chunk($num, callable $closure)
    {
        return $this->model->chunk($num, $closure);
    }

    public function with($relation)
    {
        $this->model = $this->model->with($relation);
        return $this;
    }
}
