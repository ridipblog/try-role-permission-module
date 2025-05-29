<?php
declare(strict_types=1);

namespace BugLock\rolePermissionModule\Http\Helpers;

use Exception;
use BugLock\rolePermissionModule\Models\Permission;

trait PermissionHelper
{

    public function initPermissionHelper() {}

    //Add New Permission
    private function addPermission($permissions)
    {
        try {
            //Convert User Format to Database Format
            $new_format = $this->convertFormat($permissions);

            //Add New Permission
            Permission::insert($new_format);

            $this->fails=false;
            $this->latest_permissions = $permissions;
        } catch (Exception $err) {
            $this->fails=true;
            $this->reason="Error in createPermission method " . $err->getMessage();
            logger("Error in {$this->controller}: {$err->getMessage()}");
        }
    }
}
