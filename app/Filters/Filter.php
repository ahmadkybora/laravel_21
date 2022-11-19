<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class Filter
{
    protected $table;
    protected $filters = [];
    public function __construct($model)
    {
        $this->table = $model;
        // dd($this->table);
    }

    // public static function getTable($table)
    // {
    //     $this->table = $table;
    //     return $this;
    // }

    public function filterByAll($request)
    {
        $getKeys = array_keys($request->query('filter'));
        dd($getKeys);
        for($i = 0; $i < count($getKeys); $i++) {
            $b = [];
            $b[$i] = $getKeys[$i];
        }
        dd($b);
            $this->filters[$i] = QueryBuilder::for($this->table)
                ->allowedFilters([$getKeys])
                ->paginate($request->query('paginate'));
            // dd($this->filters);

        return $this->filters;
    }

    public function filterByExact($request)
    {
        $getKeys = array_keys($request->query('filter'));
        for($i = 0; $i < count($getKeys); $i++) {
            $this->filters = QueryBuilder::for($table)
                ->allowedFilters([AllowedFilter::exact($getKeys[$i])])
                ->paginate($request->query('paginate'));
        }
        return $this->filters;
    }

    public function filterBySortId($request)
    {
        // return QueryBuilder::for($this->table)->allowedSorts('id')->paginate(10);
        // dd($b);
        $this->filters = QueryBuilder::for($this->table)
            ->allowedSorts('id')
            ->paginate($request->query('paginate'));
            // ->get();
        return $this->filters;
    }
}