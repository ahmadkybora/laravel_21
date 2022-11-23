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
    }



    public function filterByOneColumn($request)
    {
        $getKey = array_keys($request->query('filter'));
        if(count($request->query('filter')) === 1)
            return $this->filters = QueryBuilder::for($this->table)
                ->allowedFilters([$getKey[0]])
                ->paginate($request->query('paginate'));
                
        if(count($request->query('filter')) === 2)
            return $this->filters = QueryBuilder::for($this->table)
                ->allowedFilters([$getKey[0], $getKey[1]])
                ->paginate($request->query('paginate'));
    }

    public function filterByRelationship($request)
    {
        return $this->filters = QueryBuilder::for($this->table)
            ->allowedIncludes([$request->query('include')])
            ->paginate($request->query('paginate'));
    }

    public function filterBySort($request)
    {
        return $this->filters = QueryBuilder::for($this->table)
            ->allowedSorts($request->query('sort'))
            ->paginate($request->query('paginate'));
    }

    /**
     * just 2 fields
     */
    public function filterByMultiColumn($request)
    {
        $getKeys = explode(",", $request->query('fields'));
        if(count($getKeys) === 2)
            return $this->filters = QueryBuilder::for($this->table)
                ->allowedFields([$getKeys[0], $getKeys[1]])
                ->paginate($request->query('paginate'));
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
        // dd(count($getKeys));
        // dd($request->query('fields'));
        // $c = fn($getKeys) => (count($getKeys) >= 2) ? $getKeys : $getKeys[2];
        // dd(['username', 'email']);
        // dd($getKeys);


        // dd($this->table);

        // public static function getTable($table)
        // {
        //     $this->table = $table;
        //     return $this;
        // }

        // dd($request->query('fields'));
        // dd(json_encode($request->query('fields')));
        // $b = explode(",", $request->query('fields'));

        // $c = json_encode($getCount);
        // $s = str_replace("]", "", $getCount);
        // dd($getCount);
        // $b = implode(",", $getCount);
        // dd($b);
        // for($i = 0; $i < count($getCount); $i++) {

        // }
        // dd($this->filters);


        // $getKeys = array_keys($request->query('fields'));
        // dd($request->query('fields'));
        // foreach($getKeys as $key => $index) {

        // }
            // ->paginate($request->query('paginate'));

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

}