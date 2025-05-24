<?php
declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Helpers;

use Exception;
use YourVendor\rolePermissionModule\Models\Permission;

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
            // Permission::insert($new_format);

            $this->response['is_success'] = true;
            $this->latest_permissions = $permissions;
        } catch (Exception $err) {
            $this->response['is_success'] = false;
            $this->response['error'] = "{$err->getMessage()}";
            logger("Error in {$this->controller}: {$err->getMessage()}");
        }
    }
}
