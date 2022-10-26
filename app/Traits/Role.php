<?php
namespace App\Traits;

trait Permissions {

    public function givePermissionTo($request)
    {
        return $request;
    }

    public function syncPermissions($request, $role)
    {
        $role->syncPermissions($request->input('permissions'));
        return $request;
    }

}