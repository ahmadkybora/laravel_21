<?php

namespace App\Filters;

interface FilterInterface
{
    public function filterByOneColumn($request);

    public function filterByRelationship($request);

    public function filterBySort($request);

    public function filterByMultiColumn($request);

    public function filterByExact($request);

}