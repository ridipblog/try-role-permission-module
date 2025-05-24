<?php

declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Helpers;

trait AssignLocksHelper
{
    public function initAssignHelper() {}

    //Assign Role with Permission
    private function assignLocks(array $roles = [], array $permissions = [])
    {
        // Check latest or new roles and permissions
        $roles=count($roles) == 0 ? $this->latest_roles : $roles;
        $permissions=count($permissions) == 0 ? $this->latest_permissions : $permissions;

        $new_format = collect($roles)->map(function ($role) use ($permissions) {
            return collect($permissions)->map(function($permission) use ($role){
                return [
                    'role_id'=>$role,
                    'permission_id'=>$permission
                ];
            })->toArray();
            
        });
        dd($new_format[0]);
    }
}
