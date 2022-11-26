<?php
namespace App\Traits;

trait FilterTrait
{
    public function filter($request, $model, $filter)
    {
        if($request->query('filter')) {
            return $model = $filter->filterByOneColumn($request);
        } else if($request->query('include')) {
            return $model = $filter->filterByRelationship($request);
        } else if($request->query('sort')) {
            return $model = $filter->filterBySort($request);
        } else if($request->query('fields')) {
            return $model = $filter->filterByMultiColumn($request);
        } else if($request->query('all')) {
            return $model = $model->all();
        }
    }
}