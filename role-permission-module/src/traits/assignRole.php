<?php

declare(strict_types=1);

namespace BugLock\rolePermissionModule\traits;

use BugLock\rolePermissionModule\Models\Role;
use BugLock\rolePermissionModule\Models\UserRoles;
use Exception;

trait assignRole
{
    public function assignRoleToUser(string $role)
    {
        $primary_key=config('buglocks.primary_key');
        try {
            $role_id = Role::select('id')
                ->where('name', $role)
                ->first();
            if (!$role_id) {
                $this->fails = true;
                $this->reason = "Role is not define";
            } else {
                $user_id = $this[$primary_key];
                UserRoles::create([
                    'user_id' => $user_id,
                    'role_id' => $role_id->id ?? null
                ]);
                $this->fails = true;
                $this->reason = null;
            }
        } catch (Exception $err) {
            $this->fails = true;
            $this->reason = "A problem is occur ".$err->getMessage();
        }
    }
}
