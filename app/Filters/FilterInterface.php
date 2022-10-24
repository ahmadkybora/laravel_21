<?php

namespace App\Filters;

interface FilterInterface
{
    public function where($column, $request);
}