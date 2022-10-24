<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Model;

class Filter implements FilterInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function where($column, $request)
    {
        $this->model->where($column, 'Like', '%' . $request . '%')->get();
        return $this->model;
    }
}