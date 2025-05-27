<?php
declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Helpers;

use Exception;
use YourVendor\rolePermissionModule\Models\Role;

trait RoleHelper
{


    // Manual constructor 
    public function initRoleHelper() {}

    //Add new role
    private function addRole($role)
    {
        try {
            // convert user format into database format
            $new_format = $this->convertFormat($role);

            //add to database
            // Role::insert($new_format);

            $this->fails=false;
            $this->latest_roles = $role;
        } catch (Exception $err) {
            $this->fails=true;
            $this->reason="Error in createRole Method " . $err->getMessage();
            logger("Error in {$this->controller}: {$err->getMessage()}");
        }
    }

    //List of all roles
    private function listRoles()
    {
        try {
            $this->response['roles'] = Role::select('id', 'name')
                ->get();
            $this->response['is_success'] = true;
        } catch (Exception $err) {
            $this->response['is_success'] = false;
            $this->response['error'] = "{$err->getMessage()}";
            logger("Error in {$this->controller}: {$err->getMessage()}");
        }
    }
}
