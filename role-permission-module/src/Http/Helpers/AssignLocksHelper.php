<?php

declare(strict_types=1);

namespace BugLock\rolePermissionModule\Http\Helpers;

use Exception;
use BugLock\rolePermissionModule\Models\AssignLocks;

trait AssignLocksHelper
{
    use databaseHelper;
    public function initAssignHelper() {}

    //Assign Role with Permission
    private function assignLocks(array $roles = [], array $permissions = [])
    {
        try {
            // Check latest or new roles and permissions
            $roles = count($roles) == 0 ? $this->latest_roles : $roles;
            $permissions = count($permissions) == 0 ? $this->latest_permissions : $permissions;

            //Get roles table primary  id 
            $roles = $this->setHolders('roles', [
                'id'
            ])->byRoleName($roles)
                ->getHelpers();
            if (!$this->fails) {
                // Get permission primary id
                $permissions = $this->setHolders('permissions', [
                    'id'
                ])->byRoleName($permissions)
                    ->getHelpers();

                if (!$this->fails) {
                    // generate database format
                    $new_format = collect($roles)->flatMap(function ($role) use ($permissions) {
                        return collect($permissions)->map(function ($permission) use ($role) {
                            return [
                                'role_id' => $role->id ?? null,
                                'permission_id' => $permission->id ?? null
                            ];
                        });
                    })->toArray();
                                        
                    // add combination in database 
                    AssignLocks::insert($new_format);
                }
            }
        } catch (Exception $err) {
            $this->fails = true;
            $this->reason = "Error in assignLocks Method " . $err->getMessage();
        }

        // dd($new_format);
    }
}
