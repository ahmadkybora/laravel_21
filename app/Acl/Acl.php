<?php
namespace App\Acl;

use Illuminate\Database\Eloquent\Model;

class Acl implements AclInterface
{
    protected $filter;

    public function __construct(Model $model)
    {
        $this->filter = $model;
    }

    public function all($request)
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
}