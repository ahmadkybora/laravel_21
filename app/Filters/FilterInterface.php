<?php

namespace App\Filters;

interface FilterInterface
{
    public function filterByAll($request);

    public function filterByExact($request);
}