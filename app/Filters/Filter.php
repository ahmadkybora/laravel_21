<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class Filter implements FilterInterface
{
    protected $filter;

    public function __construct(Model $model)
    {
        $this->filter = $model;
    }

    public function filterByAll($request)
    {
        $filter = [];
        $getKeys = array_keys($request->filter);
        for($i = 0; $i < count($getKeys); $i++) {
            $filter = QueryBuilder::for($this->filter)
                ->allowedFilters([$getKeys[$i]])
                ->get();
        }
        return $filter;
    }

    public function filterByExact($request)
    {
        $filter = [];
        $getKeys = array_keys($request->filter);
        for($i = 0; $i < count($getKeys); $i++) {
            $filter = QueryBuilder::for($this->filter)
                ->allowedFilters([AllowedFilter::exact($getKeys[$i])])
                ->get();
        }
        return $filter;
    }
}