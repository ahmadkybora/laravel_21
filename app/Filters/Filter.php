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

    public function filterByOneColumn($request)
    {
        return $this->filters = QueryBuilder::for($this->table)
            ->allowedFilters([array_keys($request->query('filter'))[0]])
            ->paginate($request->query('paginate'));
    }

    public function filterByRelationship($request)
    {

        return $this->filters = QueryBuilder::for($this->table)
            ->allowedIncludes('posts')
            ->get();
    }

    public function filterBySort($request)
    {
        return $this->filters = QueryBuilder::for($this->table)
            ->allowedSorts($request->query('sort'))
            ->paginate($request->query('paginate'));
    }

    public function filterByMultiColumn($request)
    {
        // $getKeys = array_keys($request->query('fields'));
        // dd($request->query('fields'));
        // foreach($getKeys as $key => $index) {
            $this->filters = QueryBuilder::for($this->table)
                ->allowedFields([$request->query('fields')])
                ->get();
        // }
            // ->paginate($request->query('paginate'));
    }
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
        // dd($getKeys);

        // dd(array_key_exists($index, $getKeys));
        // dd($c($getKeys));
        // function a($getKeys) {
        //     for($i = 0; $i < count($getKeys); $i++) {
        //         $b[$i] = $getKeys[$i];
        //     }
        // }
        // // dd($getKeys);
        // implode(" ",$getKeys);
        // $c = fn($getKeys) => $getKeys[0];
        // $getKeys = array_keys($request->query('filter'));
        // dd($request->query('filter'));

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

}