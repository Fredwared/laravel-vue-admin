<?php
namespace App\Traits;


trait HelpersTrait
{
    public function scopeWithCertain($query, $relation, array $columns = ['*'])
    {
        return $query->with([$relation => function ($query) use ($columns) {
            $query->select($columns);
        }]);
    }
}