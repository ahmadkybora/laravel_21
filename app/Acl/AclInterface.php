<?php

namespace App\Acl;

interface AclInterface
{
    public function all($request);

    public function filterByExact($request);
}