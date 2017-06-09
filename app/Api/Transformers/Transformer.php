<?php
namespace App\Api\Transformers;


use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{
    public function get($model, $key, $default = null)
    {
        return isset($model->$key) ? $model->$key : $default;
    }
}