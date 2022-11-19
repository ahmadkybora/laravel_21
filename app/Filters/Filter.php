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
        // $b = [];
        // foreach(array_keys($request->query('filter')) as $key => $index) {
        //     $b[$key] = $index;
        // }
        // dd(array_values($b));
        // $b = [];
        // $b = array_merge($b, array_values($getKeys));
        // dd($b);
        // for($i = 0; $i < count($getKeys); $i++) {
        //     $b = [];
        //     $b[$i] = $getKeys[$i];
        // }
        // dd($b);
        function a($getKeys) {
            for($i = 0; $i < count($getKeys); $i++) {
                dd($getKeys);
                $b = [];
                $b[$i] = $getKeys[$i];
            }
        }

        $this->filters = QueryBuilder::for($this->table)
            ->allowedFilters([a($getKeys)])
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